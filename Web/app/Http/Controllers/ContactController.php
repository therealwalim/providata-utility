<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index()
    {
        $contacts = Contact::all();
        return $contacts->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        /*$contact = new Contact();
        $contact->name = $request->name;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->users_id = $request->user_id;
        $contact->save();
        */
        //$mydata = $request->all();
        //$json = json_decode($mydata, true);

        foreach ($request->json()->all() as $record) {
            $contact = new Contact();
            $contact->name = $record['name'];
            $contact->phone = $record['phone'];
            $contact->users_id = $record['users_id'];
            $contact->save();
        }

        //Contact::insert($json);
        //$data = dd($request->all());
        //$data = $request->json()->all();
        return response()->json([
            "code" => 200,
            "message" => "Contacts added successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($contact)
    {
        $result = Contact::find($contact);
        return $result;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if ($contact->update($request->all())) {
            return response()->json([
                'success' => 'Contact updated with success'
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        $deletion = $contact->delete();
        return response()->json([
            "code" => 200,
            "message" => "Contact deleted successfully"
        ]);
    }
}
