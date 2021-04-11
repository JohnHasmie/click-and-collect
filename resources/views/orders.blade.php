<x-app-layout>
    <section class="text-gray-700 body-font overflow-hidden bg-white flex justify-center">
        <table class="table-auto border-green-800">
            <thead>
                <tr>
                    <th scope="col">Order No.</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Order Amount</th>
                    <th scope="col">Qty.</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->order_number }}</th>
                        <td>{{ $order->first_name }}</td>
                        <td>{{ $order->last_name }}</td>
                        <td>{{ config('settings.currency_symbol') }}{{ round($order->grand_total, 2) }}</td>
                        <td>{{ $order->item_count }}</td>
                        <td><span class="badge badge-success">{{ strtoupper($order->status) }}</span></td>
                    </tr>
                @empty
                    <div class="col-sm-12">
                        <p class="alert alert-warning">No orders to display.</p>
                    </div>
                @endforelse
            </tbody>
        </table>
    </section>
</x-app-layout>