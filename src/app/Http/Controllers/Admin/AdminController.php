<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function admin()
    {
        $contacts = Contact::paginate(7);
        $categories = Category::all();
        $currentPage = $contacts->currentPage();
        $lastPage = $contacts->lastPage();
        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);
        if ($end - $start < 4) {
            if ($start === 1) {
                $end = min($lastPage, $start + 4);
            } elseif ($end === $lastPage) {
            $start = max(1, $end - 4);
            }
        }
        $pages = range($start, $end);
        $genderLabels = [
            '1' => '男性',
            '2' => '女性',
            '3' => 'その他',
        ];
        $categoryIdLabels = [
            '1' => '商品のお届けについて',
            '2' => '商品の交換について',
            '3' => '商品トラブル',
            '4' => 'ショップへのお問い合わせ',
            '5' => 'その他'
        ];
        return view('admin.admin', compact(
            'contacts',
            'categories',
            'pages',
            'genderLabels',
            'categoryIdLabels'
        ));
    }
    public function search(Request $request)
    {
        $contacts = Contact::with('category')
            ->keywordSearch($request->input('keyword'))
            ->genderSearch($request->input('gender'))
            ->categorySearch($request->input('category_id'))
            ->dateSearch($request->input('date'))
            ->paginate(7);
        $categories = Category::all();
        $currentPage = $contacts->currentPage();
        $lastPage = $contacts->lastPage();
        $start = max(1, $currentPage - 2);
        $end = min($lastPage, $currentPage + 2);
        if ($end - $start < 4) {
            if ($start === 1) {
                $end = min($lastPage, $start + 4);
            } elseif ($end === $lastPage) {
            $start = max(1, $end - 4);
            }
        }
        $pages = range($start, $end);
        $genderLabels = [
            '1' => '男性',
            '2' => '女性',
            '3' => 'その他',
        ];
        $categoryIdLabels = [
            '1' => '商品のお届けについて',
            '2' => '商品の交換について',
            '3' => '商品トラブル',
            '4' => 'ショップへのお問い合わせ',
            '5' => 'その他'
        ];
        return view('admin.admin', compact(
            'contacts',
            'categories',
            'pages',
            'genderLabels',
            'categoryIdLabels'
        ));
    }
    public function export(Request $request): StreamedResponse
    {
        $contacts = $this->searchContacts($request)->get();
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts.csv"',
        ];
        $callback = function () use ($contacts) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, [
                'id',
                '姓',
                '名',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容'
            ]);
            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->last_name,
                    $contact->first_name,
                    $contact->gender_label,
                    $contact->email,
                    $contact->tel,
                    $contact->address,
                    $contact->building,
                    $contact->category->content ?? '',
                    $contact->detail,
                ]);
            }
            fclose($handle);
        };
        return response()->stream($callback, 200, $headers);
    }
    private function searchContacts(Request $request)
    {
        return Contact::with('category')
            ->keywordSearch($request->input('keyword'))
            ->genderSearch($request->input('gender'))
            ->categorySearch($request->input('category_id'))
            ->dateSearch($request->input('date'));
    }
    public function delete($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.admin')->with('success', '削除が完了しました');
    }
}
