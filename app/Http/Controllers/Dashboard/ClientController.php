<?php

namespace App\Http\Controllers\Dashboard;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%')
                ->orWhere('phone', 'like', '%' . $request->search . '%')
                ->orWhereTranslationLike('address', '%' . $request->search . '%');
        })->latest()->paginate(10);

        return view('dashboard.clients.index', compact('clients'));
    } //end of index

    public function create()
    {
        return view('dashboard.clients.create');
    } //end of create

    public function store(Request $request)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => 'required'];
            $rules += [$locale . '.address' => 'required'];
        } //end of for each
        $rules += [
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
        ];

        $request->validate($rules);

        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);

        Client::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.clients.index');
    } //end of store

    public function edit(Client $client)
    {
        return view('dashboard.clients.edit', compact('client'));
    } //end of edit

    public function update(Request $request, Client $client)
    {
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => 'required'];
            $rules += [$locale . '.address' => 'required'];
        } //end of for each
        $rules += [
            'phone' => 'required|array|min:1',
            'phone.0' => 'required',
        ];

        $request->validate($rules);


        $request_data = $request->all();
        $request_data['phone'] = array_filter($request->phone);

        $client->update($request_data);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.clients.index');
    } //end of update

    public function destroy(Client $client)
    {
        $client->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.clients.index');
    } //end of destroy

}//end of controller
