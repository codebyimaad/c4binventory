// Load product details on selection
$(document).on('change', '#p_product_name', function (event) {
  event.preventDefault();
  const productId = $(this).val();

  $.post('app/ajax/find_product_details.php', { p_product_id: productId, find_p_details: 'find_p_details' }, function (data) {
    const parsedData = JSON.parse(data);
    $('#p_p_quantity').val(parsedData.quantity);
    $('#p_p_price').val(parsedData.buy_price);
    $('#p_p_sell_price').val(parsedData.sell_price);
  });
});

// Calculate total with discount and previous due
function purchase_calculate(discountPercent) {
  const discount = parseFloat(discountPercent) || 0;
  const subTotal = parseFloat($('#p_subtotal').val()) || 0;
  const previousDue = parseFloat($('#supliar_prev_total_due').val()) || 0;

  const discountAmount = (subTotal * discount) / 100;
  const netTotal = subTotal - discountAmount + previousDue;

  $('#p_discount_amount').val(discountAmount.toFixed(2));
  $('#p_netTotal').val(netTotal.toFixed(2));
}

// Update subtotal and net total on quantity input
$(document).on('keyup', '#p_pn_quantity', function (event) {
  event.preventDefault();
  const quantity = parseFloat($('#p_pn_quantity').val()) || 0;
  const price = parseFloat($('#p_p_price').val()) || 0;
  const subTotal = quantity * price;

  $('#p_subtotal').val(subTotal.toFixed(2));
  purchase_calculate($('#p_discount').val());
});

// Update totals when discount is changed
$(document).on('keyup', '#p_discount', function (event) {
  event.preventDefault();
  const discount = $(this).val();
  purchase_calculate(discount);
});

// Update supplier previous due when supplier changes
$(document).on('change', '#p_supliar', function (event) {
  event.preventDefault();
  const supplierId = $(this).val();

  $.ajax({
    url: 'app/ajax/find_suppliar_due.php',
    method: 'POST',
    dataType: 'json',
    data: { getsuppliarTotalDue: 1, id: supplierId },
    success: function (data) {
      $('#supliar_prev_total_due').val(data.total_due || 0);
      purchase_calculate($('#p_discount').val());
    }
  });
});

// Manual discount amount input
$(document).on('keyup', '#p_discount_amount', function (event) {
  event.preventDefault();
  const discountAmount = parseFloat($(this).val()) || 0;
  const subTotal = parseFloat($('#p_subtotal').val()) || 0;
  const previousDue = parseFloat($('#supliar_prev_total_due').val()) || 0;

  const netTotal = subTotal - discountAmount + previousDue;
  $('#p_netTotal').val(netTotal.toFixed(2));
});

// Calculate due on paid bill entry
$(document).on('keyup', '#p_paidBill', function (event) {
  event.preventDefault();
  const paid = parseFloat($('#p_paidBill').val()) || 0;
  const netTotal = parseFloat($('#p_netTotal').val()) || 0;
  const due = netTotal - paid;
  $('#p_dueBill').val(due.toFixed(2));
});

// Submit purchase form
$(document).on('click', '#addByproductBtn', function (event) {
  event.preventDefault();

  if (
    $('#p_supliar').val() &&
    $('#puchar_date').val() &&
    $('#p_product_name').val() &&
    $('#p_pn_quantity').val() &&
    $('#p_p_price').val() &&
    $('#p_p_sell_price').val() &&
    $('#p_payMethode').val()
  ) {
    const paid = parseFloat($('#p_paidBill').val()) || 0;
    const netTotal = parseFloat($('#p_netTotal').val()) || 0;

    if (paid <= netTotal) {
      $.ajax({
        url: 'app/action/buy_product.php',
        method: 'POST',
        data: $('#addByproductForm').serialize(),
        success: function (data) {
          if ($.trim(data) === 'yes') {
            alert('Product purchase successful');
            $('#addByproductForm')[0].reset();
          } else {
            alert(data);
          }
        }
      });
    } else {
      alert('Paid amount should not be greater than net total');
    }
  } else {
    alert('Please fill out all required fields');
  }
});

// Edit purchase
$(document).on('click', '#purchaseEditBtn', function (event) {
  event.preventDefault();
  $.ajax({
    url: 'app/action/edit_purchase.php',
    method: 'POST',
    data: $('#purchaseEditForm').serialize(),
    success: function (data) {
      alert(data);
    }
  });
});

// Handle supplier payment
$('#purchase_payForm').submit(function (event) {
  event.preventDefault();
  const amount = parseFloat($('#pay_amount').val()) || 0;
  const date = $('#payment_date').val();

  if (amount > 0) {
    if (date) {
      $.ajax({
        type: 'POST',
        url: 'app/action/purchase_payment.php',
        data: $(this).serialize(),
        success: function (data) {
          if ($.trim(data) === 'yes') {
            alert('Payment successful');
            window.location.href = 'index.php?page=suppliar';
          } else {
            alert(data);
          }
        }
      });
    } else {
      alert('Please select a payment date');
    }
  } else {
    alert('Pay amount must be greater than 0');
  }
});

// Handle sell payment
$('#sell_payForm').submit(function (event) {
  event.preventDefault();
  const amount = parseFloat($('#spay_amount').val()) || 0;
  const type = $('#spay_type').val();

  if (amount > 0) {
    if (type) {
      $.ajax({
        type: 'POST',
        url: 'app/action/sell_payment.php',
        data: $(this).serialize(),
        success: function (data) {
          alert(data);
        }
      });
    } else {
      alert('Please select a payment type');
    }
  } else {
    alert('Pay amount must be greater than 0');
  }
});

// Handle purchase return
$('#purchaserreturnBtn').on('click', function (event) {
  event.preventDefault();
  const quantityAvailable = parseInt($('#p_p_quantity').val()) || 0;
  const quantityReturn = parseInt($('#p_pn_quantity').val()) || 0;

  if (confirm('Are you sure you want to refund this?')) {
    if (quantityReturn > quantityAvailable) {
      alert('Refund quantity cannot be more than purchase quantity');
    } else {
      $.ajax({
        type: 'POST',
        url: 'app/action/purchase_return.php',
        data: $('#purchasereturnForm').serialize(),
        success: function (data) {
          if ($.trim(data) === 'yes') {
            alert('Product refund successful');
            location.reload();
          } else {
            alert(data);
          }
        }
      });
    }
  }
});
