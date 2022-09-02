function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur) {
    var input_val = input.val();

    if (input_val === "") {
        return;
    }

    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");

    if (input_val.indexOf(".") >= 0) {
        var decimal_pos = input_val.indexOf(".");
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        left_side = formatNumber(left_side);
        right_side = formatNumber(right_side);

        if (blur === "blur") {
            right_side += "00";
        }

        right_side = right_side.substring(0, 2);
        input_val = left_side + "." + right_side;

    } else {
        input_val = formatNumber(input_val);
        if (blur === "blur") {
            input_val += ".00";
        }
    }

    input.val(input_val);

    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

function actions(actions = [], tableId = null, rowData = null) {

    let actionView = `<div class="d-flex justify-content-center">`;
    if (actions.view !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-info" style="margin-right: 10px" onclick="window.location.href='${actions.view}'">
                <i class="fa fa-eye"></i>
            </button>`;
    }
    if (actions.checkPass !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-info" style="margin-right: 10px" onclick="checkPassword('${actions.checkPass}', '${tableId}')">
                <i class="fa fa-eye"></i>
            </button>`;
    }
    if (actions.edit !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-primary" style="margin-right: 10px" onclick="window.location.href='${actions.edit}'">
            <i class="fa fa-pencil"></i>
        </button>`;
    }

    if (actions.statusAccept !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-success" style="margin-right: 10px" onclick="statusUpdate('${actions.statusAccept}', '${tableId}')">
            <i class="fa fa-check"></i>
        </button>`;
    }

    if (actions.statusRemove !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" style="margin-right: 10px" onclick="statusUpdate('${actions.statusRemove}', '${tableId}')">
            <i class="fa fa-times"></i>
        </button>`;
    }
    if (actions.del !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" style="margin-right: 10px" onclick="fnDelete('${actions.del}', '${tableId}')">
            <i class="fa fa-trash"></i>
        </button>`;
    }
    if (actions.delCat !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" style="margin-right: 10px" onclick="fnCategory('${actions.delCat}', '${tableId}')">
            <i class="fa fa-trash"></i>
        </button>`;
    }
    if (actions.accept !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-success" style="margin-right: 10px" onclick="fnAccept('${actions.accept}', '${tableId}')">
            <i class="fa fa-check"></i>
        </button>`;
    }

    if (actions.reject !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" style="margin-right: 10px" onclick="fnReject('${actions.reject}', '${tableId}')">
            <i class="fa fa-times"></i>
        </button>`;
    }
    if (actions.claim !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-success" style="margin-right: 10px" onclick="fnReject('${actions.claim}', '${tableId}')">Claim
        </button>`;
    }
    if (actions.unclaim !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-info" style="margin-right: 10px" onclick="fnReject('${actions.unclaim}', '${tableId}')">Unclaim
        </button>`;
    }
    if (actions.rejectClaim !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" style="margin-right: 10px" onclick="fnReject('${actions.rejectClaim}', '${tableId}')">Reject
        </button>`;
    }
    if (actions.resend_mail !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-primary" style="margin-right: 10px" onclick="fnSendMail('${actions.resend_mail}', '${tableId}')">
            <i class="fa fa-envelope"></i>
        </button>`;
    }

    if (actions.receipt !== undefined) {
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-primary" style="margin-right: 10px" onclick="window.location.href='${actions.receipt}'">
            <i class="fa fa-download"></i>
        </button>`;
    }

    if (actions.feature !== undefined) {
        // <i className="${rowData.is_featured ? 'fa fa-check-square-o' : 'fa fa-square-o'}"></i>
        actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-info" title="Feature" style="margin-right: 10px" onclick="fnFeature('${actions.feature}', '${tableId}', '${rowData?.is_featured}')">
            <i class="fa fa-shirtsinbulk"></i>
        </button>`;
    }

    actionView += `</div>`;

    return actionView;
}

function fnCategory(url, tableId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "If yes, than it can't be restore!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (!result.isConfirmed) {
            return false;
        }

        $.ajax({
            type: "delete",
            url: url,
            dataType: "json",
            success: function (response) {
                if (response.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        timer: 2000
                    });
                    $('#' + tableId).DataTable().ajax.reload(null, false);
                } else if (response.status == 2) {
                    window.location.href = response.url
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg.join('&'),
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.msg.join('&'),
                });
            }
        });
    })
}

function fnDelete(url, tableId) {

    Swal.fire({
        title: 'Are you sure?',
        text: "If yes, than it can't be restore!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (!result.isConfirmed) {
            return false;
        }

        $.ajax({
            type: "delete",
            url: url,
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        timer: 2000
                    });
                    $('#' + tableId).DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg.join('&'),
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.msg.join('&'),
                });
            }
        });
    })
}

function statusUpdate(url, tableId) {

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to change this status ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        console.log(tableId)
        if (!result.isConfirmed) {
            return false;
        }

        $.ajax({
            type: "put",
            url: url,
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        timer: 2000
                    });
                    $('#' + tableId).DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg.join('&'),
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.msg.join('&'),
                });
            }
        });
    })
}

function loadDataTable({tableId, url, columns, columnDefs = null, pageLength = 25, slTarget = 0}) {
    // console.log(id);
    let columnDefsZero = [
        {
            targets: slTarget,
            createdCell: function (td, cellData, rowData, row) {
                $(td).html(this.api().page.info().start + row + 1);
            }
        }]

    if (columnDefs === null) {
        columnDefs = columnDefsZero
    } else {
        $.merge(columnDefs, columnDefsZero)
    }

    return $('#' + tableId).DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        cache: false,
        autoWidth:false,
        // stateSave: true,
        pageLength: pageLength,
        ajax: url,
        columns: columns,
        columnDefs: columnDefs,
    });
}


function fnAccept(url, tableId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "If confirmed, gbc added in user account!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (!result.isConfirmed) {
            return false;
        }

        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        timer: 2000
                    });
                    $('#' + tableId).DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg.join('&'),
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.msg.join('&'),
                });
            }
        });
    })
}

function fnReject(url, tableId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "If confirmed, user bank transfer will be rejected!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (!result.isConfirmed) {
            return false;
        }

        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        timer: 2000
                    });
                    $('#' + tableId).DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg.join('&'),
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.msg.join('&'),
                });
            }
        });
    })
}

function readFile(input, viewId) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#' + viewId)
                .attr('src', e.target.result)
                .width(150)
                .height(150);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function fnRemoveDenomination(row) {
    $('#denomination_' + row).remove();
}


function fnSendMail(url, tableId) {
    Swal.fire({
        title: 'Do you want to resend mail?',
        text: "If confirmed, user will be notified.!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (!result.isConfirmed) {
            return false;
        }

        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        timer: 2000
                    });
                    $('#' + tableId).DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg.join('&'),
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.msg.join('&'),
                });
            }
        });
    })
}


function checkPassword(url, tableId) {
    Swal.fire({
        title: 'Enter Password',
        html: `
        <input type="password" id="screect" class="swal2-input" placeholder="Password" autocomplete="off">`,
        // title: "Are you sure you want to delete your account?",
        // text: "If you are sure, type in your password:",
        // type: "input",
        // inputType: "password",
        confirmButtonText: 'Check',
        showCancelButton: true,
        confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
        cancelButtonColor: '#d33',
        showLoaderOnConfirm: true,
        didOpen: () => {
            $("#cardProduct_filter").hide();
        },
        willClose: () => {
            $("#cardProduct_filter").show();
        },
        // closeOnConfirm: false
        // inputAttributes: {
        //     autocomplete: 'off'
        // }
        preConfirm: () => {
            const password = Swal.getPopup().querySelector('#screect').value
            if (!password) {
                Swal.showValidationMessage(`Please enter  password`)
            }
            return {password: password}
        }
    }).then((result) => {
        $('#login').hide();
        if (!result.isConfirmed) {
            return false;
        }
        $.ajax({
            type: "post",
            url: '/check-permission-password',
            data: {
                'password': result.value.password,
            },
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        timer: 2000
                    });
                    window.location.href = url
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password was not correct',
                    });
                }
            },
            error: function (error) {
                // console.log(error)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.msg.join('&'),
                });
            }
        })
    })
}

function optionValueChange($url, $id, $target, $relation) {
    let output = document.getElementById($target);
    if ($target == 'state') {
        let city = document.getElementById('city');
        city.innerHTML = '';
        city.innerHTML += ` <option value=''>Select city</option>`
        var option = document.createElement("option");
        city.add(option);
    }
    $.ajax({
        type: "GET",
        url: $url,
        data: {id: $id}
    }).done(function (data) {
        output.innerHTML = ''
        output.innerHTML += ` <option value=''>Select ` + $target + `</option>`
        if ($target == 'state') {
            // console.log('out');
            data[0].states.map(item => {
                var option = document.createElement("option");
                option.text = item.name;
                option.value = item.id;
                output.add(option);
            })
        } else {
            // console.log(data);
            data.map(item => {
                var option = document.createElement("option");
                option.text = item.name;
                option.value = item.id;
                output.add(option);
            })
        }
    });
}

function fnFeature(url, tableId, isFeatured) {

    let text = ''
    if (isFeatured !== '1') {
        text = "If yes, then this card added to featured!"
    } else {
        text = "If yes, then this card removed from featured!"
    }

    Swal.fire({
        title: 'Are you sure?',
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (!result.isConfirmed) {
            return false;
        }

        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function (response) {
                if (response.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success...',
                        timer: 2000
                    });
                    $('#' + tableId).DataTable().ajax.reload(null, false);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.msg.join('&'),
                    });
                }
            },
            error: function (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: error.responseJSON.msg.join('&'),
                });
            }
        });
    })
}
function viewNew($url, tableId)
{
    let input =`<div class="card ">
        <div class="card-body text-center">
            <span class="avatar avatar-xxl brround cover-image cover-image" data-image-src="" id="image"></span>
            <h4 class="h4 mb-0 mt-3" id="name"></h4>
            <p class="card-text" id="qulaification">Test</p>
        </div>
        </div>`
    Swal.fire({
        title: 'Value will be calculated in percentage.',
        html: input,
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Submit',
        showLoaderOnConfirm: true,
    }).then((result) => {})
}
function cardCurrencyGlobalUpdate(url, tableId) {

    let input = `<div class="form-group">
                  <label class="form-label" for="value" style="float: left">Value:</label>
                  <input class="form-control numeric" id="value" type="number" autocomplete="false" min="0" max="100" placeholder="Enter value" onkeydown="return (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 13 || event.keyCode === 9) ? true : !isNaN(Number(event.key))"></input>
                </div>
                <div class="form-group">
                  <label class="form-label" for="type" style="float: left">Type:</label>
                  <select class="form-control swal-select" id="type" type="text">
                    <option value="increase">Increase</option>
                    <option value="decrease">Decrease</option>
                  </select>
                </div>`

    Swal.fire({
        title: 'Value will be calculated in percentage.',
        html: input,
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Submit',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(url, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    value: $('#value').val(),
                    type: $('#type').val()
                })
            })
                .then(response => {
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`)
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((response) => {
        if (response.isConfirmed) {
            if (response.value.status === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    timer: 2000
                });
                $('#' + tableId).DataTable().ajax.reload(null, false);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.value.msg.join('&'),
                });
            }
        }
    });
}

function cardVoucherUpdate(url, element = null) {

    let input = `<div class="form-group">
                  <label class="form-label" for="value" style="float: left">Number of voucher:</label>
                  <input class="form-control numeric" id="voucher_number" name="voucher_number" type="number" placeholder="Enter number of voucher" min="0" max="100" onkeydown="return (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 13 || event.keyCode === 9) ? true : !isNaN(Number(event.key))" />
                </div>
                <div class="form-group">
                  <label class="form-label" for="value" style="float: left">Original Price:</label>
                  <input class="form-control numeric" id="main_price" name="main_price" type="number" placeholder="Enter original price" autocomplete="false" min="0" max="100" onkeydown="return (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 13 || event.keyCode === 9) ? true : !isNaN(Number(event.key))" />
                </div>
                <div class="form-group">
                  <label class="form-label" for="value" style="float: left">Main Price:</label>
                  <input class="form-control numeric" id="original_price" name="original_price" type="number" placeholder="Enter main price" autocomplete="false" min="0" max="100" onkeydown="return (event.keyCode === 8 || event.keyCode === 46 || event.keyCode === 13 || event.keyCode === 9) ? true : !isNaN(Number(event.key))" />
                </div>
                <div class="row m-0">
                    <div class="col-md-6 p-0">
                        <div class="form-group form-elements">
                            <div class="form-label" style="text-align: left">Choose format</div>
                            <div class="custom-controls-stacked">
                                <label class="custom-control custom-radio voucher_format" style="text-align: left">
                                    <input type="radio" class="custom-control-input" name="customRadio" value="number" checked>
                                    <span class="custom-control-label">Only Number</span>
                                </label>
                                <label class="custom-control custom-radio voucher_format" style="text-align: left">
                                    <input type="radio" class="custom-control-input" name="customRadio" value="text">
                                    <span class="custom-control-label">Only Text</span>
                                </label>
                                <label class="custom-control custom-radio voucher_format" style="text-align: left">
                                    <input type="radio" class="custom-control-input" name="customRadio" value="both">
                                    <span class="custom-control-label">Both</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <div class="form-group form-elements">
                            <div class="form-label" style="text-align: left">Choose type of code</div>
                            <div class="custom-controls-stacked">
                                <label class="custom-control custom-radio voucher_format" style="text-align: left">
                                    <input type="radio" class="custom-control-input" name="codeRadio" value="6" checked>
                                    <span class="custom-control-label">6 characters</span>
                                </label>
                                <label class="custom-control custom-radio voucher_format" style="text-align: left">
                                    <input type="radio" class="custom-control-input" name="codeRadio" value="9">
                                    <span class="custom-control-label">9 characters</span>
                                </label>
                                <label class="custom-control custom-radio voucher_format" style="text-align: left">
                                    <input type="radio" class="custom-control-input" name="codeRadio" value="16">
                                    <span class="custom-control-label">16 characters</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>`

    Swal.fire({
        title: 'Generate new vouchers on the card.',
        html: input,
        inputAttributes: {
            autocapitalize: 'off',
        },
        showCancelButton: true,
        confirmButtonText: 'Submit',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch(url, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    voucher_number: $('#voucher_number').val(),
                    original_price: $("#original_price").val(),
                    main_price: $("#main_price").val(),
                    customRadio: $("input[type='radio']:checked").val(),
                    codeRadio: $("input[name='codeRadio']:checked").val()
                })
            })
                .then(response => {
                    return response.json()
                })
                .catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`)
                })
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then((response) => {
        if (response.isConfirmed) {
            if (response.value.status === true) {

                if (element !== null) {
                    loadView(url, element)

                }
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    timer: 2000
                });

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.value.msg.join('&'),
                });
            }
        }
    });
}

function loadView(url, element) {
    $(element).load(url);
}

function showInputField() {
    $('#submit').show();
}

function rejectDeposit(url) {
    $('#submit').hide();

    $.ajax({
        type: "get",
        url: url,
        dataType: "json",
        success: function (response) {
            if (response.status === true) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success...',
                    timer: 2000
                });

                history.back()
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: response.msg.join('&'),
                });
            }
        },
        error: function (error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: error.responseJSON.msg.join('&'),
            });
        }
    });
}
