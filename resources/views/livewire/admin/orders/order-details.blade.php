{{-- show details --}}
<div class="grid grid-cols-1 gap-6 p-3 ">
    @include('admin.layouts.loading')
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <h5 class="text-lg font-semibold dark:text-white-light">لیست محصولات</h5>
            </div>
        </div>
        @if ($details->isEmpty())
            <hr class="mb-4">
            <div class="text-center text-gray-500 ">موردی یافت نشد</div>
        @else
            <div class="mb-5">
                <div class="mt-3 table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام محصول</th>
                                <th>گارانتی</th>
                                <th>رنگ</th>
                                <th>قیمت پایه محصول</th>
                                <th>تخفیف</th>
                                <th>قیمت نهایی</th>
                                <th>تعداد</th>
                                <th>وضعیت </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $index => $detail)
                                <tr>
                                    <td>{{ $details->firstItem() + $index }}</td>
                                    <td>{{ $detail->product->name }}</td>
                                    <td>{{ $detail->warranty?->name }}</td>
                                    <td>{{ $detail->color?->name}}</td>
                                    <td>{{ number_format($detail->main_price) }}</td>
                                    <td>{{ number_format($detail->discount) }}</td>
                                    <td>{{ number_format($detail->final_price) }}</td>
                                    <td>{{ $detail->count }}</td>
                                    <td>
                                        
                                        @if($detail->status === 'sent')
                                            <button type="button" wire:click="change_status({{ $detail->id }})" class="btn btn-success btn-sm">ارسال شده</button>
                                            
                                        @elseif($detail->status === 'canceled')
                                            <button type="button" wire:click="change_status({{ $detail->id }})" class="btn btn-danger btn-sm">لغو شده</button>
                                        @elseif($detail->status === 'in_progress')
                                        
                                            <button type="button" wire:click="change_status({{ $detail->id }})" class="btn btn-warning btn-sm">درحال بررسی</button>
                                        @endif
                                    
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- pagination --}}
                    <div class="panel">
                        <div class="flex flex-col justify-center w-full">
                            {{ $details->links('admin.layouts.admin_pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('sweetAlert', (data) => {
            const alertMessage = data['message']
            const alertType = data['type']
            showAlert(alertMessage, alertType);
        });
        Livewire.on('deleteConfirm', (event) => {
            const product_id = event.product_id;
            deleteProduct(product_id);
        });
    });
</script>
