<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Routing\RequestContext;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompanyResource::collection(Company::orderBy('created_at','desc')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->validated());

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return response()->noContent();
    }
    public function posting(Request $req){
        $c=Company::where('user_id',$req->user_id)
        ->where('name',$req->name)
        ->where('status',$req->statut)
        ->count();
        if($c==0){
            $c=new Company();
            $c->user_id=$req->user_id;
            $c->name=$req->name;
            $c->statut="En cours";
            $c->save();
            return "saved";
        }
        else{
            return "used";
        }
    }
    public function updating(Request $red,$id){
        
        //$count=Company::where('name',$red->name)->where('statut',$red->statut)->count();
        //if($count==1){
            $c=Company::find($id);
            $c->update($red->all());
            return $c;
        //}else{
          //  return "used";
        //}
        

        

    }
    public function getcompanyByID($id)
        {
            return CompanyResource::collection(Company::where('user_id',$id)->orderBy('created_at','desc')->paginate(5));
        }
    public function my_companies_fnct($id){
        return CompanyResource::collection(Company::where('user_id',$id)->get());
    }

}
