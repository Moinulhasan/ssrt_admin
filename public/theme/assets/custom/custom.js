// function loadDataTable(tableId, url, columns, columnDefs = null,search=true) {
//     // console.log(url)
//     let columnDefsZero = [
//         {
//             targets: 0,
//             createdCell: function (td, cellData, rowData, row) {
//                 $(td).html(this.api().page.info().start + row + 1);
//             }
//         }]
//
//     if (columnDefs === null) {
//         columnDefs = columnDefsZero
//     } else {
//         $.merge(columnDefs, columnDefsZero)
//     }
//
//     $('#' + tableId).DataTable({
//         processing: true,
//         serverSide: true,
//         ordering: false,
//         pageLength: 25,
//         searching:search,
//         ajax: url,
//         columns: columns,
//         // dom:'<"toolbar">frtip',
//         columnDefs: columnDefs
//     });
//     $("div.toolbar").html('<b>Custom tool bar! Text/images etc.</b>');
// }
// function actions(actions = [], tableId = null) {
//     // console.log(actions.del)
//     let actionView = `<div class="d-flex justify-content-around">`;
//     if (actions.view !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-info" onclick="window.location.href='${actions.view}'">
//                 <i class="fa fa-eye"></i>
//             </button>`;
//     }
//
//     if (actions.edit !== undefined) {
//         actionView += `<button class="border-0  btn btn-sm btn-outline-primary" onclick="window.location.href='${actions.edit}'">
//             <i class="fa fa-pencil"></i>
//         </button>`;
//     }
//
//     if (actions.del !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" onclick="fnDelete('${actions.del}', '${tableId}')">
//             <i class="fa fa-trash"></i>
//         </button>`;
//     }
//
//     if (actions.accept !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-success" onclick="fnAccept('${actions.accept}', '${tableId}')">
//             <i class="fa fa-check"></i>
//         </button>`;
//     }
//
//     if (actions.reject !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" onclick="fnReject('${actions.reject}', '${tableId}')">
//             <i class="fa fa-times"></i>
//         </button>`;
//     }
//     if (actions.avail !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-primary" title="publish" onclick="fnAvailable('${actions.avail}', '${tableId}')">
//             <span>Available</span>
//         </button>`;
//     }
//
//     if (actions.unavail !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" title="publish" onclick="fnAvailable('${actions.unavail}', '${tableId}')">
//             <span>Unavailable</span>
//         </button>`;
//     }
//
//     if (actions.pub !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-info" title="publish" onclick="fnAvailable('${actions.pub}', '${tableId}')">
// <!--            <i class="fa fa-check-square-o"></i>-->
//             <span>Publish</span>
//         </button>`;
//     }
//     if (actions.unpub !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-danger" title="publish" onclick="fnAvailable('${actions.unpub}', '${tableId}')">
//             <span>Unpublish</span>
//         </button>`;
//     }
//
//     if (actions.add_sub !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-success" title="publish" onclick="window.location.href='${actions.add_sub}'">
//             <span>Add Category</span>
//         </button>`;
//     }
//
//     if (actions.add_coupon !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-success" title="publish" onclick="window.location.href='${actions.add_coupon}'">
//             <span>Add Coupon</span>
//         </button>`;
//     }
//     if (actions.add_product !== undefined) {
//         actionView += `<button class="border-0 btn-transition btn btn-sm btn-outline-success" title="publish" onclick="window.location.href='${actions.add_product}'">
//             <span>Add Product</span>
//         </button>`;
//     }
//
//     actionView += `</div>`;
//
//     return actionView;
// }
// function fnAccept(url,tableId)
// {
//     console.log(url)
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "Do you want to Approved",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes'
//     }).then((result) => {
//         if (!result.isConfirmed) {
//             return false;
//         }
//         //
//         $.ajax({
//             type: "put",
//             url: url,
//             dataType: "json",
//             success: function (response) {
//                 if (response.status) {
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success...',
//                         timer: 2000
//                     });
//                     $('#' + tableId).DataTable().ajax.reload(null, false);
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: response.msg.join('&'),
//                     });
//                 }
//             },
//             error: function (error) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: error.responseJSON.msg.join('&'),
//                 });
//             }
//         });
//     })
// }
// function fnReject(url,tableId)
// {
//     console.log(url)
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "Do you want to reject this item ?",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes'
//     }).then((result) => {
//         if (!result.isConfirmed) {
//             return false;
//         }
//         //
//         $.ajax({
//             type: "put",
//             url: url,
//             dataType: "json",
//             success: function (response) {
//                 if (response.status) {
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success...',
//                         timer: 2000
//                     });
//                     $('#' + tableId).DataTable().ajax.reload(null, false);
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: response.msg.join('&'),
//                     });
//                 }
//             },
//             error: function (error) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: error.responseJSON.msg.join('&'),
//                 });
//             }
//         });
//     })
// }
// function fnAvailable(url,tableId)
// {
//     console.log(url)
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "Do you want to update this status",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes'
//     }).then((result) => {
//         if (!result.isConfirmed) {
//             return false;
//         }
//         //
//         $.ajax({
//             type: "put",
//             url: url,
//             dataType: "json",
//             success: function (response) {
//                 if (response.status) {
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success...',
//                         timer: 2000
//                     });
//                     $('#' + tableId).DataTable().ajax.reload(null, false);
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: response.msg.join('&'),
//                     });
//                 }
//             },
//             error: function (error) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: error.responseJSON.msg.join('&'),
//                 });
//             }
//         });
//     })
// }
// function fnDelete(url, tableId) {
//     console.log(url)
//     Swal.fire({
//         title: 'Are you sure?',
//         text: "If yes, than it can't be restore!",
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: "linear-gradient(310deg, #7928ca, #ff0080)",
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Yes'
//     }).then((result) => {
//         if (!result.isConfirmed) {
//             return false;
//         }
//
//         $.ajax({
//             type: "delete",
//             url: url,
//             dataType: "json",
//             success: function (response) {
//                 if (response.status) {
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success...',
//                         timer: 2000
//                     });
//                     $('#' + tableId).DataTable().ajax.reload(null, false);
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Oops...',
//                         text: response.msg.join('&'),
//                     });
//                 }
//             },
//             error: function (error) {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: error.responseJSON.msg.join('&'),
//                 });
//             }
//         });
//     })
// }
//
//
// function optionValueChange($url,$id,$target,$relation)
// {
//     let output = document.getElementById($target);
//     if ($target == 'state')
//     {
//         let city = document.getElementById('city');
//         city.innerHTML = '';
//         city.innerHTML += ` <option value=''>Select state</option>`
//         var option = document.createElement("option");
//         city.add(option);
//     }
//     $.ajax({
//         type: "GET",
//         url: $url,
//         data:{id:$id}
//     }).done(function(data){
//         output.innerHTML = ''
//         output.innerHTML += ` <option value=''>Select state</option>`
//         if ($target == 'state')
//         {
//             console.log('out');
//             data[0].state.map(item => {
//                 var option = document.createElement("option");
//                 option.text = item.name;
//                 option.value = item.id;
//                 // if (selectedSubCat != undefined && item.id == selectedSubCat) {
//                 //     option.selected = true
//                 // }
//                 output.add(option);
//             })
//         }else{
//             console.log(data);
//             data.map(item => {
//                 var option = document.createElement("option");
//                 option.text = item.name;
//                 option.value = item.id;
//                 // if (selectedSubCat != undefined && item.id == selectedSubCat) {
//                 //     option.selected = true
//                 // }
//                 output.add(option);
//             })
//         }
//     });
// }
//
// function urlExists(url) {
//     var http = new XMLHttpRequest();
//     http.open('HEAD', url, false);
//     http.send();
//     // window.console.log;
//     if (http.status != 404)
//         return true;
//     else
//         return false;
// }
