<?php

namespace App\Http\Controllers\Admin\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
        $this->middleware(['auth', 'role:super_admin']);
    }

    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.super.settings.index', compact('settings'));
    }

    public function updateGeneral(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_name' => 'required|string|max:100',
            'store_email' => 'required|email|max:100',
            'store_phone' => 'required|string|max:20',
            'store_address' => 'required|string|max:500',
            'store_description' => 'nullable|string|max:1000',
            'timezone' => 'required|string',
            'currency' => 'required|string|max:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($request->all() as $key => $value) {
            $this->settingService->set($key, $value);
        }

        return redirect()->route('admin.super.settings.index')
            ->with('success', 'Pengaturan umum berhasil diperbarui!');
    }

    public function updatePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payment_methods' => 'required|array',
            'payment_methods.*' => 'string|in:bank_transfer,credit_card,e_wallet',
            'bank_transfer_account' => 'nullable|string|max:100',
            'bank_transfer_number' => 'nullable|string|max:50',
            'bank_transfer_name' => 'nullable|string|max:100',
            'midtrans_server_key' => 'nullable|string|max:100',
            'midtrans_client_key' => 'nullable|string|max:100',
            'midtrans_enabled' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($request->all() as $key => $value) {
            if ($key === 'payment_methods') {
                $value = implode(',', $value);
            }
            $this->settingService->set($key, $value);
        }

        return redirect()->route('admin.super.settings.index')
            ->with('success', 'Pengaturan pembayaran berhasil diperbarui!');
    }

    public function updateShipping(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_methods' => 'required|array',
            'shipping_methods.*' => 'string|in:standard,express,same_day',
            'shipping_cost_standard' => 'required|numeric|min:0',
            'shipping_cost_express' => 'required|numeric|min:0',
            'shipping_cost_same_day' => 'required|numeric|min:0',
            'free_shipping_threshold' => 'nullable|numeric|min:0',
            'shipping_zone' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        foreach ($request->all() as $key => $value) {
            if ($key === 'shipping_methods') {
                $value = implode(',', $value);
            }
            $this->settingService->set($key, $value);
        }

        return redirect()->route('admin.super.settings.index')
            ->with('success', 'Pengaturan pengiriman berhasil diperbarui!');
    }
}