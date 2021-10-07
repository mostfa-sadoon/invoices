<?php
namespace App\Http\Controllers;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Requests\SectionRequest;
use App\Http\Requests\UpdateSection;
use Illuminate\Support\Facades\Auth;
class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sections=Section::all();
        return view('sections.sections',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionRequest $request)
    {
        //
     
           Section::create([
                'section_name'=>$request->section_name,
                'description'=>$request->description,
                'created_by'=>Auth::user()->name
           ]);
           session()->flash('add',"تم الاضافه بنجاح");
           return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSection $request)
    {
        //
          $id=$request->id;
          $section=Section::find($id);
          $section->update([
              'section_name'=>$request->section_name,
              'description'=>$request->description,
          ]);
          session()->flash('edit','تم تعديل القسم بنجاح');
          return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $id=$request->id;
        $section=Section::find($id);
        $section->delete();
        session()->flash('delete','تم الحذف بنجاح');
        return redirect()->back();
    }
}
