<?php $script = '<script>
                    function printInvoice() {
                        var printContents = document.getElementById("invoice").innerHTML;
                        var originalContents = document.body.innerHTML;

                        document.body.innerHTML = printContents;

                        window.print();

                        document.body.innerHTML = originalContents;
                    }
                </script>';?>

<?php include './partials/layouts/layoutTop.php' ?>

        <div class="dashboard-main-body">

            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
                <h6 class="fw-semibold mb-0">Invoice List</h6>
                <ul class="d-flex align-items-center gap-2">
                    <li class="fw-medium">
                        <a href="index.php" class="d-flex align-items-center gap-1 hover-text-primary">
                            <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                            Dashboard
                        </a>
                    </li>
                    <li>-</li>
                    <li class="fw-medium">Invoice List</li>
                </ul>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2">
                        <a href="javascript:void(0)" class="btn btn-sm btn-primary-600 radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="pepicons-pencil:paper-plane" class="text-xl"></iconify-icon>
                            Send Invoice
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="solar:download-linear" class="text-xl"></iconify-icon>
                            Download
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-success radius-8 d-inline-flex align-items-center gap-1">
                            <iconify-icon icon="uil:edit" class="text-xl"></iconify-icon>
                            Edit
                        </a>
                        <button type="button" class="btn btn-sm btn-danger radius-8 d-inline-flex align-items-center gap-1" onclick="printInvoice()">
                            <iconify-icon icon="basil:printer-outline" class="text-xl"></iconify-icon>
                            Print
                        </button>
                    </div>
                </div>
                <div class="card-body py-40">
                    <div class="row justify-content-center" id="invoice">
                        <div class="col-lg-8">
                            <div class="shadow-4 border radius-8">
                                <div class="p-20 d-flex flex-wrap justify-content-between gap-3 border-bottom">
                                    <div>
                                        <h3 class="text-xl">Invoice #3492</h3>
                                        <p class="mb-1 text-sm">Date Issued: 25/08/2020</p>
                                        <p class="mb-0 text-sm">Date Due: 29/08/2020</p>
                                    </div>
                                    <div>
                                        <img src="assets/images/logo.png" alt="image" class="mb-8">
                                        <p class="mb-1 text-sm">4517 Washington Ave. Manchester, Kentucky 39495</p>
                                        <p class="mb-0 text-sm">random@gmail.com, +1 543 2198</p>
                                    </div>
                                </div>
                                <div class="py-28 px-20">
                                    <div class="d-flex flex-wrap justify-content-between align-items-end gap-3">
                                        <div>
                                            <h6 class="text-md">Issus For:</h6>
                                            <table class="text-sm text-secondary-light">
                                                <tbody>
                                                    <tr>
                                                        <td>Name</td>
                                                        <td class="ps-8">:Will Marthas</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Address</td>
                                                        <td class="ps-8">:4517 Washington Ave.USA</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone number</td>
                                                        <td class="ps-8">:+1 543 2198</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div>
                                            <table class="text-sm text-secondary-light">
                                                <tbody>
                                                    <tr>
                                                        <td>Issus Date</td>
                                                        <td class="ps-8">:25 Jan 2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Order ID</td>
                                                        <td class="ps-8">:#653214</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipment ID</td>
                                                        <td class="ps-8">:#965215</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="mt-24">
                                        <div class="table-responsive scroll-sm">
                                            <table class="table bordered-table text-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" class="text-sm">SL.</th>
                                                        <th scope="col" class="text-sm">Items</th>
                                                        <th scope="col" class="text-sm">Qty</th>
                                                        <th scope="col" class="text-sm">Units</th>
                                                        <th scope="col" class="text-sm">Unit Price</th>
                                                        <th scope="col" class="text-end text-sm">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>01</td>
                                                        <td>Apple's Shoes</td>
                                                        <td>5</td>
                                                        <td>PC</td>
                                                        <td>$200</td>
                                                        <td class="text-end">$1000.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>02</td>
                                                        <td>Apple's Shoes</td>
                                                        <td>5</td>
                                                        <td>PC</td>
                                                        <td>$200</td>
                                                        <td class="text-end">$1000.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>03</td>
                                                        <td>Apple's Shoes</td>
                                                        <td>5</td>
                                                        <td>PC</td>
                                                        <td>$200</td>
                                                        <td class="text-end">$1000.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>04</td>
                                                        <td>Apple's Shoes</td>
                                                        <td>5</td>
                                                        <td>PC</td>
                                                        <td>$200</td>
                                                        <td class="text-end">$1000.00</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex flex-wrap justify-content-between gap-3">
                                            <div>
                                                <p class="text-sm mb-0"><span class="text-primary-light fw-semibold">Sales By:</span> Jammal</p>
                                                <p class="text-sm mb-0">Thanks for your business</p>
                                            </div>
                                            <div>
                                                <table class="text-sm">
                                                    <tbody>
                                                        <tr>
                                                            <td class="pe-64">Subtotal:</td>
                                                            <td class="pe-16">
                                                                <span class="text-primary-light fw-semibold">$4000.00</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-64">Discount:</td>
                                                            <td class="pe-16">
                                                                <span class="text-primary-light fw-semibold">$0.00</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-64 border-bottom pb-4">Tax:</td>
                                                            <td class="pe-16 border-bottom pb-4">
                                                                <span class="text-primary-light fw-semibold">0.00</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="pe-64 pt-4">
                                                                <span class="text-primary-light fw-semibold">Total:</span>
                                                            </td>
                                                            <td class="pe-16 pt-4">
                                                                <span class="text-primary-light fw-semibold">$1690</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-64">
                                        <p class="text-center text-secondary-light text-sm fw-semibold">Thank you for your purchase!</p>
                                    </div>

                                    <div class="d-flex flex-wrap justify-content-between align-items-end mt-64">
                                        <div class="text-sm border-top d-inline-block px-12">Signature of Customer</div>
                                        <div class="text-sm border-top d-inline-block px-12">Signature of Authorized</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

<?php include './partials/layouts/layoutBottom.php' ?>