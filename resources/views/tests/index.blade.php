<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chọn sản phẩm</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
            min-height: 38px;
        }

        .selection-table {
            margin-top: 20px;
        }

        .selection-table th {
            background-color: #f8f9fa;
        }

        .remove-btn {
            color: #dc3545;
            cursor: pointer;
        }

        .remove-btn:hover {
            color: #bb2d3b;
        }

        .select2-results__option {
            padding: 8px 12px;
        }

        .product-info {
            display: flex;
            justify-content: space-between;
        }

        .product-name {
            font-weight: 500;
        }

        .product-price {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-boxes me-2"></i>Chọn sản phẩm</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <form action="/test" method="post">
                        @csrf
                        <div class="col-md-8 mx-auto">
                            <label for="productSelect" class="form-label fw-bold">Tìm kiếm sản phẩm:</label>
                            <select id="productSelect" name="products[]" id="productSelect" class="form-select"
                                multiple="multiple">
                                <!-- Các sản phẩm đã chọn trước sẽ hiển thị ở đây -->
                                @if (isset($selectedProducts))
                                    @foreach ($selectedProducts as $product)
                                        <option value="{{ $product->id }}" selected>
                                            {{ $product->name }} - {{ number_format($product->price, 0, ',', '.') }}₫
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <button style="float: right;" type="submit" class=" mt-2 btn btn-primary me-2"
                                id="">
                                <i class="fas fa-save me-1"></i> Lưu lại
                            </button>
                            <small class="text-muted">Gõ ít nhất 2 ký tự để bắt đầu tìm kiếm</small>
                        </div>

                    </form>
                </div>

                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3"><i class="fas fa-list-check me-2"></i>Sản phẩm đã chọn</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover selection-table">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th width="50%">Tên sản phẩm</th>
                                        <th width="20%">Giá</th>
                                        <th width="15%">Hình ảnh</th>
                                        <th width="10%">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedProductsTable">
                                    @if (isset($selectedProducts) && count($selectedProducts) > 0)
                                        @foreach ($selectedProducts as $index => $product)
                                            <tr data-product-id="{{ $product->id }}">
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td class="text-end">{{ number_format($product->price, 0, ',', '.') }}₫
                                                </td>
                                                <td class="text-center">
                                                    @if ($product->image_url)
                                                        <img src="{{ asset($product->image_url) }}"
                                                            alt="{{ $product->name }}" width="50">
                                                    @else
                                                        <span class="text-muted">Không có ảnh</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-outline-danger remove-btn"
                                                        onclick="removeProduct({{ $product->id }})">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">Chưa có sản phẩm nào
                                                được chọn</td>
                                        </tr>
                                    @endif
                                </tbody>
                                {{--  @if (isset($selectedProducts) && count($selectedProducts) > 0)
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-end">Tổng cộng:</th>
                                            <th class="text-end">{{ number_format(array_sum(array_column($selectedProducts, 'price')), 0, ',', '.') }}₫</th>
                                            <th colspan="2"></th>
                                        </tr>
                                    </tfoot>
                                @endif  --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light">

                <button type="button" class="btn btn-outline-secondary" id="resetBtn">
                    <i class="fas fa-undo me-1"></i> Đặt lại
                </button>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Khởi tạo Select2 với AJAX
            $('#productSelect').select2({
                placeholder: "Nhập tên sản phẩm...",
                allowClear: true,
                minimumInputLength: 0, // Cho phép tìm kiếm ngay từ ký tự đầu tiên
                language: {
                    noResults: function() {
                        return 'Không tìm thấy sản phẩm';
                    },
                    searching: function() {
                        return 'Đang tìm kiếm...';
                    }
                },
                ajax: {
                    url: '{{ route('api.products.search') }}',
                    type: 'GET',
                    dataType: 'json',
                    delay: 300,
                    data: function(params) {
                        return {
                            q: params.term || '', // Gửi chuỗi rỗng nếu không có input
                            page: params.page || 1
                        };
                    },
                    processResults: function(response, params) {
                        params.page = params.page || 1;

                        return {
                            results: response.data.map(product => ({
                                id: product.id,
                                text: product.name,
                                price: product.price,
                                image: product.image_url || null
                            })),
                            pagination: {
                                more: response.next_page_url ? true : false
                            }
                        };
                    },
                    cache: true
                },
                // Hiển thị toàn bộ sản phẩm khi khởi tạo
                initSelection: function(element, callback) {
                    // Load toàn bộ sản phẩm khi khởi tạo
                    $.ajax({
                        url: '{{ route('api.products.search') }}',
                        type: 'GET',
                        data: {
                            q: ''
                        }, // Chuỗi rỗng để lấy tất cả
                        dataType: 'json',
                        success: function(response) {
                            var data = response.data.map(product => ({
                                id: product.id,
                                text: `${product.name} (${formatCurrency(product.price)})`,
                                price: product.price,
                                image: product.image_url
                            }));

                            // Nếu có sản phẩm đã chọn trước
                            if (element.val()) {
                                var selected = data.filter(item =>
                                    element.val().includes(item.id.toString())
                                );
                                callback(selected);
                            }
                        }
                    });
                }
            });
            // Định dạng hiển thị kết quả tìm kiếm
            function formatProductResult(product) {
                if (product.loading) return product.text;

                var image = product.image ?
                    `<img src="${product.image}" alt="${product.text}" class="me-2" width="30" height="30" style="object-fit: cover;">` :
                    '<div class="d-inline-block me-2" style="width:30px;height:30px;"></div>';

                var price = product.price ?
                    `<span class="product-price">${formatCurrency(product.price)}</span>` :
                    '<span class="text-muted">Chưa có giá</span>';

                return $(`
                    <div class="product-info">
                        <div class="d-flex align-items-center">
                            ${image}
                            <span class="product-name">${product.text}</span>
                        </div>
                        ${price}
                    </div>
                `);
            }

            // Định dạng khi sản phẩm được chọn
            function formatProductSelection(product) {
                return product.text || product.id;
            }

            // Định dạng tiền tệ
            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(amount);
            }

            // Khi có sản phẩm được chọn hoặc bỏ chọn
            $('#productSelect').on('change', function() {
                updateSelectedProductsTable();
            });

            // Cập nhật bảng sản phẩm đã chọn
            function updateSelectedProductsTable() {
                var selectedIds = $('#productSelect').val() || [];

                // Gửi AJAX để lấy thông tin chi tiết các sản phẩm đã chọn
                if (selectedIds.length > 0) {
                    $.ajax({
                        url: '{{ route('api.products.getSelected') }}',
                        type: 'POST',
                        data: {
                            ids: selectedIds,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            renderProductsTable(response.data);
                        },
                        error: function(xhr) {
                            console.error('Lỗi khi lấy thông tin sản phẩm:', xhr.responseText);
                        }
                    });
                } else {
                    renderProductsTable([]);
                }
            }

            // Hiển thị danh sách sản phẩm vào bảng
            function renderProductsTable(products) {
                var tableBody = $('#selectedProductsTable');
                tableBody.empty();

                if (products.length === 0) {
                    tableBody.append(`
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Chưa có sản phẩm nào được chọn</td>
                        </tr>
                    `);
                    return;
                }

                // Thêm từng sản phẩm vào bảng
                $.each(products, function(index, product) {
                    var image = product.image_url ?
                        `<img src="${product.image_url}" alt="${product.name}" width="50">` :
                        '<span class="text-muted">Không có ảnh</span>';

                    var row = `
                        <tr data-product-id="${product.id}">
                            <td>${index + 1}</td>
                            <td>${product.name}</td>
                            <td class="text-end">${formatCurrency(product.price)}</td>
                            <td class="text-center">${image}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger remove-btn" onclick="removeProduct(${product.id})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                    tableBody.append(row);
                });

                // Cập nhật tổng tiền
                updateTotalPrice(products);
            }

            // Cập nhật tổng tiền
            {{--  function updateTotalPrice(products) {
                var total = products.reduce((sum, product) => sum + parseFloat(product.price), 0);
                
                // Kiểm tra nếu đã có footer tổng tiền
                var footer = $('tfoot');
                if (footer.length === 0) {
                    $('#selectedProductsTable').after(`
                        <tfoot>
                            <tr>
                                <th colspan="2" class="text-end">Tổng cộng:</th>
                                <th class="text-end">${formatCurrency(total)}</th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    `);
                } else {
                    footer.find('th:nth-child(3)').text(formatCurrency(total));
                }
            }  --}}

            // Xóa sản phẩm
            window.removeProduct = function(productId) {
                // Xóa khỏi select2
                var currentSelected = $('#productSelect').val();
                $('#productSelect').val(currentSelected.filter(id => id != productId)).trigger('change');
            };

            // Nút đặt lại
            $('#resetBtn').click(function() {
                $('#productSelect').val(null).trigger('change');
            });

            // Nút lưu lại
            $('#submitBtn').click(function() {
                var selectedIds = $('#productSelect').val() || [];

                if (selectedIds.length === 0) {
                    alert('Vui lòng chọn ít nhất một sản phẩm');
                    return;
                }

                // Gửi dữ liệu lên server
                $.ajax({
                    url: '{{ route('products.storeSelected') }}',
                    type: 'POST',
                    data: {
                        product_ids: selectedIds,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Lưu sản phẩm thành công!');
                        // Có thể chuyển hướng hoặc làm gì đó sau khi lưu
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra khi lưu sản phẩm');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>

</html>
