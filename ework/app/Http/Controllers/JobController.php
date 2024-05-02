<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{

    public function index() {
        return view('home', [
            'jobs' => Job::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function show(Job $job) {
        return view('jobs.job', [
            'job' => $job
        ]);
    }

    public function create() {
        return view('jobs.create');
    }

    public function addJob(Request $request) {
        $formFields = $request->validate([
            'title'=> 'required',
            'company' => 'required',
            'email' => 'required|email|unique:jobs',
            'website' => 'required',
            'location' => 'required',
            'description' => 'required',
            'tags' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = Auth()->id();

        Job::create($formFields);


        return redirect('/');
    }


    public function manage(Job $job) {
        return view('manage', [
            'jobs' => Job::where('user_id', '=', Auth::id())->latest()->paginate(6)
        ]);
    }

    public function edit($id) {

        $job = Job::find($id);

        return view("jobs.edit", [
            'job'=> $job
        ]);
    }

    public function editJob(Request $request, $id) {

        $formFields = $request->validate([
            'title'=> 'required',
            'company' => 'required',
            'email' => 'required|email',
            'website' => 'required',
            'location' => 'required',
            'description' => 'required',
            'tags' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = Auth()->id();

        Job::where('id', $id)->update($formFields);


        return redirect('/manage');
    }



    public function delete($id) {

        $job = Job::where('id', $id)->first();

        if ($job != null) {
            Job::where('id', $id)->delete();
        }

       return redirect('/manage');
    }


}
