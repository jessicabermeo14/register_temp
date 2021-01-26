<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Visitor;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Http\Requests\VisitorRequest;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::all();
        return view('visitors.list')->with('visitors', $visitors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($verification_document = '')
    {
        return view('visitors.form')->with('verification_document', $verification_document);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorRequest $request)
    {
        Visitor::create($request->all());
        $verification_id = Visitor::where('document_number', '=', $request->document_number)->get();
        return view('records.form')->with('verification_id', $verification_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visitor = Visitor::find($id);
        return view('visitors.edit')->with('visitor', $visitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $visitor = Visitor::find($id);
        $visitor->update($request->all());
        return redirect('/visitantes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $visitor = Visitor::find($id);
        $visitor->delete();
        return redirect('/visitantes');
    }

    public function home()
    {
        return view('visitors.check');
    }


    public function search(Request $request)
    {
        $request->validate([
            'document' => 'required'
        ]);

        $verification_document = $request->document;

        if (Visitor::where('document_number', $verification_document)->exists()) {

            $verification_id = Visitor::where('document_number', '=', $verification_document)->get();
            return view('records.form')->with('verification_id', $verification_id);
        } else {

            return redirect('visitantes/create')->with($verification_document);
        }
    }
}
