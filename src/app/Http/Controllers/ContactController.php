<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::with('category')->get();
        $categories = Category::all();
        return view('contact.index', compact(
            'contacts',
            'categories'
        ));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'first_name', 'last_name',
            'gender',
            'email',
            'tel_1', 'tel_2', 'tel_3',
            'address',
            'building',
            'category_id',
            'detail'
        ]);
        $name = $request->input('last_name').' '.$request->input('first_name');
        $categoryIdLabels = Category::pluck('content', 'id')->toArray();
        $genderLabels = [
            '1' => '男性',
            '2' => '女性',
            '3' => 'その他',
        ];
        $tel = $request->input('tel_1').$request->input('tel_2').$request->input('tel_3');
        $contact['tel'] = $tel;
        return view('contact.confirm', compact(
            'contact',
            'name',
            'categoryIdLabels',
            'genderLabels'
        ));
    }
    public function store(ContactRequest $request)
    {
        $action = $request->input('action');
        if ($action === 'submit')
        {
            $contact = $request->only([
                'first_name', 'last_name',
                'gender',
                'email',
                'tel',
                'tel_1', 'tel_2', 'tel_3',
                'address',
                'building',
                'category_id',
                'detail'
            ]);
            Contact::create($contact);
            return view('contact.thanks', compact('contact'));
        }
        if ($action === 'modify')
        {
            return redirect()->route('contact.index')->withInput();
        }
    }
}
