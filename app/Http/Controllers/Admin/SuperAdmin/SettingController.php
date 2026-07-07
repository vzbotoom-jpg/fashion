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
    }

    /**
     * Display settings index page
     */
    public function index()
    {
        return view('admin.super.settings.index');
    }

    /**
     * Display general settings page
     */
    public function general()
    {
        $settings = [
            'store_name' => config('app.name'),
            'store_email' => config('mail.from.address'),
            'store_phone' => '',
            'timezone' => config('app.timezone'),
            'currency' => 'IDR',
            'store_address' => '',
            'store_description' => '',
        ];

        return view('admin.super.settings.general', compact('settings'));
    }

    /**
     * Display payment settings page
     */
    public function payment()
    {
        $settings = [
            'payment_methods' => 'bank_transfer,credit_card,e_wallet',
            'bank_transfer_account' => '',
            'bank_transfer_number' => '',
            'bank_transfer_name' => '',
            'midtrans_server_key' => '',
            'midtrans_client_key' => '',
            'midtrans_enabled' => false,
        ];

        return view('admin.super.settings.payment', compact('settings'));
    }

    /**
     * Display shipping settings page
     */
    public function shipping()
    {
        $settings = [
            'shipping_methods' => 'standard,express,same_day',
            'shipping_cost_standard' => 20000,
            'shipping_cost_express' => 50000,
            'shipping_cost_same_day' => 100000,
            'free_shipping_threshold' => 500000,
            'shipping_zone' => 'Indonesia',
        ];

        return view('admin.super.settings.shipping', compact('settings'));
    }

    /**
     * Update general settings
     */
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
            if ($key !== '_token' && $key !== '_method') {
                $this->settingService->set($key, $value);
            }
        }

        return redirect()->route('admin.super.settings.general')
            ->with('success', 'Pengaturan umum berhasil diperbarui!');
    }

    /**
     * Update payment settings
     */
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
            if ($key === '_token' || $key === '_method') {
                continue;
            }
            
            if ($key === 'payment_methods') {
                $value = implode(',', $value);
            }
            
            $this->settingService->set($key, $value);
        }

        return redirect()->route('admin.super.settings.payment')
            ->with('success', 'Pengaturan pembayaran berhasil diperbarui!');
    }

    /**
     * Update shipping settings
     */
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
            if ($key === '_token' || $key === '_method') {
                continue;
            }
            
            if ($key === 'shipping_methods') {
                $value = implode(',', $value);
            }
            
            $this->settingService->set($key, $value);
        }

        return redirect()->route('admin.super.settings.shipping')
            ->with('success', 'Pengaturan pengiriman berhasil diperbarui!');
    }
}