<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        // جلب المستخدمين الذين دورهم 'customer' فقط
        $customers = Customer::whereHas('user', function($query) {
            $query->where('role', 'customer');
        });
        $customers = Customer::All();
      // dd($customers);
        $users = User::All();
        return view('backend.customers.index', compact('customers','users'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
                // تحقق مما إذا كان مديرًا وإذا لم يكن لديه معرف المستخدم (user_id)
        if ((auth()->user()->role === 'admin'  || auth()->user()->role === 'employee') && !$request->has('user_id')) {
            Auth::logout(); // تسجيل خروج المدير
            return redirect()->route('register')
                            ->with('info', 'Please create a new user account first.');
        }
        return view('backend.customers.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $messages = [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone number field is required.',
            'phone.numeric' => 'The phone number is not valid.',
            'specialty.required' => 'The specialty field is required.',
            'work.required' => 'The work field is required.',
            'nationality.required' => 'The nationality field is required.',
            'current_location.required' => 'The current location field is required.',
            'gender.required' => 'The gender field is required.',
            'birthday.required' => 'The date of birth field is required.',

        ];
        $request->validate([
            'phone'=> 'required|numeric',
            'work'=>  'required',
            'nationality'=> 'required',
            'current_location' => 'required',
            'gender'=>  'required',
            'birthday'=> 'required',

        ], $messages);

                    // التحقق من عمر المستخدم
        /*    $age = Carbon::parse($request->birthday)->age;
            if ($age < 18) {
                return redirect()->back()->withErrors(['birthday' => 'You must be over 18 years of age to register.']);
            }
*/

        // الحصول على المستخدم المسجل
        $user = auth()->user();
        $customer = new Customer($request->all());
        $user->customer()->save($customer);
        // التحقق من وجود المستخدم
        if ($user &&  $user->role == 'customer') {
            $customer = $user->customer;
            return view('backend.customers.showyou', compact('customer','user'));
        }
        return redirect()->route('customers.index')
                        ->with('success','customer created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $user = auth()->user();
        $users = User::all();
        return view('backend.customers.show',compact('customer','users'));
    }

    public function showCustomerByUserId($userId)
    {
        $customer = Customer::where('user_id', $userId)->first();
        if (!$customer) {
            return redirect()->route('customers2.input')->with('error','Visitor information not found, please complete the data.');
        }
        $user = User::where('id', $userId)->first();
        return view('backend.customers.showyou', compact('customer','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('backend.customers.edit',compact('customer'));
    }
    public function edityou(Customer $customer)
    {
        return view('backend.customers.edityou',compact('customer'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $messages = [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone number field is required.',
            'phone.numeric' => 'The phone number is not valid.',
            'specialty.required' => 'The specialty field is required.',
            'work.required' => 'The work field is required.',
            'nationality.required' => 'The nationality field is required.',
            'current_location.required' => 'The current location field is required.',
            'gender.required' => 'The gender field is required.',
            'birthday.required' => 'The date of birth field is required.',
        ];

        $request->validate([
            'phone'=> 'required|numeric',
            'work'=>  'required',
            'nationality'=> 'required',
            'current_location' => 'required',
            'gender'=>  'required',
            'birthday'=> 'required',

        ], $messages);

        $customer->update($request->all());

        if (Auth::user()->role === 'customer') {
            return redirect()->route('dashboard')
                             ->with('success', 'Your information has been updated successfully.');
        }
        return redirect()->route('customers.index')
                        ->with('success','Your information has been updated successfully.'  );
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')
                        ->with('success','customer deleted successfully');
    }

    public function input()
    {
        return view('backend.customers.input');
    }
    public function input2(Request $request)
    {
        $messages = [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone number field is required.',
            'phone.numeric' => 'The phone number is not valid.',
            'specialty.required' => 'The specialty field is required.',
            'work.required' => 'The work field is required.',
            'nationality.required' => 'The nationality field is required.',
            'current_location.required' => 'The current location field is required.',
            'gender.required' => 'The gender field is required.',
            'birthday.required' => 'The date of birth field is required.',
        ];

        $request->validate([
            'phone'=> 'required|numeric',
            'work'=>  'required',
            'nationality'=> 'required',
            'current_location' => 'required',
            'gender'=>  'required',
            'birthday'=> 'required',

        ], $messages);
//dd($request);
          // الحصول على المستخدم المسجل
        $user = auth()->user();
        $customer = new Customer($request->all());
        $user->customer()->save($customer);
          // التحقق من وجود المستخدم
        if ($user) {
            $customer = $user->customer;
            return view('backend.customers.showyou', compact('customer','user'));
        }
        return redirect()->route('customers.index')
                        ->with('success','Updated successfully');
    }


}
