<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\SaleHelper;
use App\Models\Article;
use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CommerceController extends Controller
{

    function index() {
        $models = User::whereNull('owner_id')
                        ->orderBy('payment_expired_at', 'ASC')
                        ->withAll()
                        ->get();
        $models = $this->setVentas($models);
        return response()->json(['models' => $models], 200);
    }

    function registerPayment($id) {
        $user = User::find($id);
        $user->payment_expired_at = $user->payment_expired_at->addMonth();
        $user->save();
        return response()->json(['model' => $this->fullModel('User', $id)], 200);
    }

    function setVentas($models) {
        foreach ($models as $model) {
            $sales = Sale::where('user_id', $model->id)
                            ->where('created_at', '>=', Carbon::now()->subMonth()->startOfMonth())
                            ->where('created_at', '<=', Carbon::now()->subMonth()->endOfMonth())
                            ->get();
            $total = 0;
            $model->count_sales = count($sales);
            foreach ($sales as $sale) {
                $total += SaleHelper::getTotalSale($sale);
            }
            $model->total_sales = $total;

            $articles = Article::where('user_id', $model->id)
                                ->where('status', 'active')
                                ->pluck('id');

            $model->count_articles = count($articles);
        }
        return $models;
    }

    function destroy($id) {
        $commerce = User::find($id);
        Article::where('user_id', $commerce->id)
                    ->delete();
        Sale::where('user_id', $commerce->id)
                    ->delete();
    }

    
}
