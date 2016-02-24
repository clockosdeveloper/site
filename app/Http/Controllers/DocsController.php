<?php

namespace App\Http\Controllers;

use App\Doc;
use Illuminate\Http\Request;

use App\Http\Requests\DocRequest;
use App\Http\Controllers\Controller;
use App\Department;
use Gate;
use Illuminate\Support\Facades\Auth;

class DocsController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');

        $this->middleware('edit_document', ['only' => ['create', 'store' ,'destroy', 'update','edit']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number = Doc::number();
        
        return view('doc.index',compact('number'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::lists('fullname', 'id');

        return view('doc.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocRequest $request)
    {

        $this->validate($request, [
            'permalink' => 'unique:docs,permalink',
        ]);

        $input = $request->all();

        if($input['lang']=='en'){
            $input['entitle'] = $input['title'];
            $input['enbody'] = $input['body'];
            $input['title'] = $input['body'] = '';
        }

        $doc = Auth::user()->docs()->create($input);

        $doc->departments()->attach($request->input('department_list'));

        flash()->success(trans('alert.new_doc'));

        return redirect('/docs/'.$doc->permalink);

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function show($permalink ,\Parsedown $parsedown)
    {

        $doc = Doc::where('permalink',$permalink)->firstOrFail();

        $this->docTrans($doc);

        $doc->body = $parsedown->text($doc->body);

        $doc->enbody = $parsedown->text($doc->enbody);

        return view('doc.show',compact('doc'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doc = Doc::where('state', 0)->findOrFail($id);

        if (Gate::denies('update', $doc)) {

            flash()->warning('Opps.');

            return redirect('/');
        }

        $this->docTrans($doc);

        $departments = Department::lists('fullname', 'id');

        return view('doc.edit', compact('doc', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DocRequest $request, $id)
    {
        $doc = Doc::findOrFail($id);

        if (Gate::denies('update', $doc)) {

            if ($request->ajax()) {
                return response(['message' => 'Opps.'], 403);
            }

            flash()->warning('Opps.');

            return redirect('/');
        }

        $input = $request->all();

        if($input['permalink'] != $doc->permalink){
            $this->validate($request, [
                'permalink' => 'unique:docs,permalink',
            ]);
        }

        $doc->update($input);

        $department_list = $request->input('department_list');

        $doc->departments()->sync($department_list);

        flash()->success(trans('form.updated'));

        return redirect('/docs/' .$doc->permalink);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Doc::where('id', $id)->
        where('user_id', \Auth::id())->
        where('state', 0)->
        delete();

        return redirect('/docs');
    }

    private function docTrans($doc){
        if(!$doc->entitle){
            flash()->warning(trans('doc.no_english_version'))->important();
            $doc->entitle = $doc->title;
            $doc->enbody = $doc->body;
        }

        if(!$doc->title){
            flash()->warning(trans('doc.no_chinese_version'))->important();
            $doc->title = $doc->entitle;
            $doc->body = $doc->enbody;
        }
    }

    public function search(Request $request)
    {

        $input = $request->all();

        $term = $input['term'];

        $query = Doc::where('title', 'LIKE', "%$term%")
                    ->orWhere('entitle', 'LIKE', "%$term%")
                    ->orWhere('keyword', 'LIKE', "%$term%");

        $number = $query->count();

        $items = $query->get()->take(30);

        return view('doc.result',compact('items','number'));
    }
}
