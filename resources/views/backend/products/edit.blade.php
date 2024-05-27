@extends('backend.main')

@section('product')
    active
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="iq-card">
            <div class="iq-card-header d-flex justify-content-between">
                <div class="iq-header-title">
                    <h4 class="card-title">Edit Product</h4>
                </div>
            </div>
            <div class="iq-card-body">
                <form action="{{ route('products.update', $product->id) }}" id="product_store" method="POST"
                    enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method('put')
                    <div class="form-row">
                        <div class="col-md-1 mb-3">
                            <div class="ms-3 form-check form-switch">
                                <input class="form-check-input" name="instock" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" value="1"
                                    {{ old('instock', $product->instock) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Instock</label>
                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <div class="ms-3 form-check form-switch">
                                <input class="form-check-input" name="redeemable" type="checkbox" role="switch"
                                    id="flexSwitchCheckChecked" value="{{ $product->redeemable }}"
                                    {{ old('status', $product->redeemable) == 1 ? 'checked' : '' }}>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Redeemable</label>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning d-none" id="whole_sale_alert" role="alert">
                        <p>Please fill in all Price and Quantity fields before confirming the whole sale.</p>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control">
                                <option selected disabled>select category</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $product->category_id ? 'selected' : '' }}>{{ $item->english_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="brand">Brand</label>
                            <select name="brand_id" id="brand" class="form-control">
                                <option selected disabled>select brand</option>
                                @foreach ($brands as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $product->brand_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name">product Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $product->name }}" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price"
                                value="{{ $product->price }}" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="d-flex flex-column">
                                <label for="price">Whole Sale</label>
                                <div class="w-100 h-100 d-flex align-items-center mt-1">
                                    <div class="btn btn-primary " data-toggle="modal" data-target="#wholeSaleModal">
                                        Add Whole Sale
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Whole Slae Input Modal -->
                        <div class="modal fade" id="wholeSaleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Whole Sale Prices</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($wholeSales)
                                            @forelse ($wholeSales as $index => $wholeSale)
                                                <div id="whole-sale-container-{{$wholeSale->id}}" class="whole-sale-input-set d-flex justify-content-around ">
                                                    <div class="mb-3 mx-1">
                                                        <label for="wholeSaleQuantity{{$index}}">Quantity</label>
                                                        <input type="number" class="form-control" id="wholeSaleQuantity{{$index}}" name="wholeSaleQuantity"  data-index="{{ $index }}" value={{$wholeSale->quantity}} required>
                                                    </div>
                                                    <div class="mb3 mx-1">
                                                        <label for="wholeSalePrice{{$index}}">Price</label>
                                                        <input type="number" class="form-control" id="wholeSalePrice{{$index}}" name="wholeSalePrice"  data-index="{{ $index }}" value={{$wholeSale->price}} required>
                                                    </div>
                                                    <div onclick="deleteWholeSale({{$wholeSale->id}})" class="d-flex align-items-center mb-3 mx-1">
                                                        <i class="ri-delete-bin-line mt-4 delete-icon" style="font-size: 20px; color:red"></i>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-center">
                                                    <p>Click Add button to create wholesale prices</p>
                                                </div>
                                            @endforelse
                                        @endif
                                        <div id="additionalInputsContainer"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeWholeSaleModalBtn">Clear</button>
                                        <button type="button" class="btn btn-success" id="addMoreBtn">Add More</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="confirmBtn">Confirm</button>
                                        <!-- Add any additional buttons or actions here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Whole Slae Input Modal -->
                        <!--Hidden Inputs -->

                            <input type="text" class="form-control" id="whole_sale_quantity" hidden name="whole_sale_quantity">

                            <input type="text" class="form-control" id="whole_sale_price" hidden name="whole_sale_price">

                        <!--Hidden Inputs -->
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Colors</label>
                            <select class="select-2 form-control" name="colors[]" multiple="multiple">
                                <option disabled>select colors</option>
                                @foreach ($colors as $item)
                                    <option value="{{ $item->id }}" @if (in_array($item->id, $product->colors->pluck('id')->toArray())) selected @endif>
                                        {{ $item->myanmar_name }} / {{ $item->english_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Sizes</label>
                            <select class="select-2 form-control" name="sizes[]" multiple="multiple">
                                <option disabled>select sizes</option>
                                @foreach ($sizes as $item)
                                    <option value="{{ $item->id }}" @if (in_array($item->id, $product->sizes->pluck('id')->toArray())) selected @endif>
                                        {{ $item->myanmar_name }} / {{ $item->english_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="instock_amount">Instock Count</label>
                            <input type="text" class="form-control" id="instock_amount" name="instock_amount" value="{{ $product->instock_amount }}" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="point">Point</label>
                            <input type="text" class="form-control" id="point" name="point" value="{{ $product->point }}" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="description"> Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3">{!! $product->description !!}</textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image">Image</label>
                            <div class="input-images"></div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateProductRequest', '#product_store') !!}
    <script>
        function deleteWholeSale (id){
            $('#whole-sale-container-'+id).remove();
        }

        function deleteNewWholeSale (id){
            $('#new-whole-sale-container-'+id).remove();
        }

        $(document).ready(function() {
            $('.select-2').select2();
            $.ajax({
                url: `/product-images/${`{{ $product->id }}`}`
            }).done(function(response) {
                if (response) {
                    $('.input-images').imageUploader({
                        preloaded: response,
                        extensions: ['.JPG', '.jpg', '.jpeg', '.png', '.gif', '.svg'],
                        mimes: [
                            'image/jpg', 'image/JPG', 'image/jpeg', 'image/png', 'image/gif',
                            'image/svg+xml'
                        ],
                        imagesInputName: 'images',
                        preloadedInputName: 'old',
                        maxSize: 2 * 1024 * 1024,
                        maxFiles: 10
                    });
                }
            });

            var inputPairCounter = 1;
            function addInputField() {
                var newInputField = '<div id="new-whole-sale-container-'+ inputPairCounter +'"  class="additional-input-set d-flex justify-content-around">' +
                                    '<div class="mb-3 mx-1">' +
                                    '<label for="wholeSaleQuantity' + inputPairCounter + '">Quantity</label>' +
                                    '<input type="number" class="form-control" id="wholeSaleQuantity' + inputPairCounter + '" name="wholeSaleQuantity' + inputPairCounter + '" required>' +
                                    '</div>' +
                                    '<div class="mb-3 mx-1">' +
                                    '<label for="wholeSalePrice' + inputPairCounter + '">Price</label>' +
                                    '<input type="number" class="form-control" id="wholeSalePrice' + inputPairCounter + '" name="wholeSalePrice' + inputPairCounter + '" required>' +
                                    '</div>' +
                                    '<div onClick="deleteNewWholeSale('+inputPairCounter+')" class="d-flex align-items-center mb-3 mx-1">' +
                                    '<i class="ri-delete-bin-line mt-4" style="font-size: 20px; color:red"></i>' +
                                    '</div>' +
                                    '</div>';

                $('#additionalInputsContainer').append(newInputField);

                inputPairCounter++;
            }

            $('#addMoreBtn').click(function () {
                addInputField();
            });

            $('#closeWholeSaleModalBtn').click(function () {
                $('.additional-input-set [name^="wholeSaleQuantity"]').val('');
                $('.additional-input-set [name^="wholeSalePrice"]').val('');
                $('#additionalInputsContainer').empty();
                inputPairCounter = 1;
            });

            // Event handler for "Confirm" button click
            $('#confirmBtn').click(function () {
                // Collect input values and store them as arrays
                var priceArray = [];
                var quantityArray = [];

                $('.whole-sale-input-set').each(function () {
                    var priceInput = $(this).find('[name="wholeSalePrice"]');
                    var quantityInput = $(this).find('[name="wholeSaleQuantity"]');

                    // Check if either the price or quantity is not empty before pushing to the arrays
                    if (priceInput.val() !== "" && quantityInput.val() !== "") {
                        priceArray.push(priceInput.val());
                        quantityArray.push(quantityInput.val());
                    }else{
                         // Display an error message or alert
                        $('#whole_sale_alert').removeClass('d-none');

                        setTimeout(function() {
                            $('#whole_sale_alert').addClass('d-none');
                        }, 3000); // Adjust the duration as needed

                        return;
                    }
                });

                   // Dynamically created input pairs
                  // Dynamically created input pairs
                $('.additional-input-set').each(function () {
                    var priceInput = $(this).find('[name^="wholeSalePrice"]');
                    var quantityInput = $(this).find('[name^="wholeSaleQuantity"]');
                    if (priceInput.val() !== "" && quantityInput.val() !== "") {
                        priceArray.push(priceInput.val());
                        quantityArray.push(quantityInput.val());
                    }else{
                         // Display an error message or alert
                        $('#whole_sale_alert').removeClass('d-none');

                        setTimeout(function() {
                            $('#whole_sale_alert').addClass('d-none');
                        }, 3000); // Adjust the duration as needed

                        return;
                    }
                });


                // Check if any Price or Quantity field is empty
                if (priceArray.some(price => !price) || quantityArray.some(quantity => !quantity)) {
                    // Display an error message or alert
                    $('#whole_sale_alert').removeClass('d-none');

                    setTimeout(function() {
                        $('#whole_sale_alert').addClass('d-none');
                    }, 3000); // Adjust the duration as needed

                    return;
                }
                // Set the values of hidden form inputs
                $('#whole_sale_price').val(JSON.stringify(priceArray));
                $('#whole_sale_quantity').val(JSON.stringify(quantityArray));

                // Display the values for testing (remove in the actual implementation)
                console.log('Whole Sale Price Array:', priceArray);
                console.log('Whole Sale Quantity Array:', quantityArray);
            });
        });


    </script>
@endpush