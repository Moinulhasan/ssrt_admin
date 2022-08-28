// import moment from "moment";

// const moment = require("moment/moment");
// $(function(e) {
// 	// function faisal()
//     // {
//         $('#userDataTable').DataTable(
//             {
//                 "ajax": {
//                     "url": "http://127.0.0.1:8000/api/all-user",
//                     "type": "GET"
//                 },
//                 // columns: [ 'id' ,'name']
//                 columns: [
//                     { data: 'id' },
//                     { data: 'name' },
//                     { data: 'email' },
//                     {data: 'valid'},
//                     {data: 'last_login'},
//                     {data:'refid'},
//                 ],
//                 columnDefs:[
//                     {
//                         targets: 3,
//                         createdCell: function (td, cellData) {
//                             switch (cellData) {
//                                 case 1:
//                                     $(td).html('<div class="tag tag-lime">Completed</div>')
//                                     break
//                                 case 0:
//                                     $(td).html('<div class="tag tag-red">Rejected</div>')
//                                     break
//                                 default:
//                                     $(td).html('<div class="badge badge-warning">Pending</div>')
//                             }
//                         }
//                     },{
//                     targets: 4,
//                         createdCell: function (td, cellData, rowData) {
//                             $(td).html('<div>'+moment(cellData).format("D MMMM YYYY LT")+'</div>');
//                         }
//                     },
//                     {
//                         targets: 5,
//                         createdCell: function (td)
//                         {
//                             $(td).html('<div class="text-center btn-list"><button class="border-0 btn-transition btn btn-sm btn-outline-primary" title="edit"><i class="fe fe-edit"></i></button>' +
//                                 '<button class="border-0 btn-transition btn btn-sm btn-outline-primary ml-5" title="delete"><i class="fa fa-trash-o"></i></button>' +
//                                 '<button class="border-0 btn-transition btn btn-sm btn-outline-primary ml-5" title="show"><i class="fe fe-eye"></i></button>'+
//                                 '<button class="border-0 btn-transition btn btn-sm btn-outline-primary ml-5" title="verify"><i class="fe fe-check-circle"></i></button></div>');
//                         }
//                     }
//                     ]
//             }
//         );
//         $('#subscriberDataTable').DataTable(
//         {
//             "ajax": {
//                 "url": "http://127.0.0.1:8000/api/all-sub",
//                 "type": "GET"
//             },
//             // columns: [ 'id' ,'name']
//             columns: [
//                 { data: 'id' },
//                 { data: 'name' },
//                 { data: 'email' },
//                 {data: 'valid'},
//                 {data: 'last_login'},
//                 {data:'refid'},
//             ],
//             columnDefs:[
//                 {
//                     targets: 3,
//                     createdCell: function (td, cellData) {
//                         switch (cellData) {
//                             case 1:
//                                 $(td).html('<div class="tag tag-lime">Completed</div>')
//                                 break
//                             case 0:
//                                 $(td).html('<div class="tag tag-red">Rejected</div>')
//                                 break
//                             default:
//                                 $(td).html('<div class="badge badge-warning">Pending</div>')
//                         }
//                     }
//                 },{
//                     targets: 4,
//                     createdCell: function (td, cellData, rowData) {
//                         $(td).html('<div>'+moment(cellData).format("D MMMM YYYY LT")+'</div>');
//                     }
//                 },
//                 {
//                     targets: 5,
//                     createdCell: function (td)
//                     {
//                         $(td).html('<div class="text-center btn-list"><button class="border-0 btn-transition btn btn-sm btn-outline-primary" title="edit"><i class="fe fe-edit"></i></button>' +
//                             '</div>');
//                     }
//                 }
//             ]
//         });
//         $('#suspiciousUserTable').DataTable(
//         {
//             "ajax": {
//                 "url": "http://127.0.0.1:8000/api/all-suspicious",
//                 "type": "GET"
//             },
//             // columns: [ 'id' ,'name']
//             columns: [
//                 { data: 'id' },
//                 { data: 'user.name' },
//                 { data: 'user.email' },
//                 { data: 'max_ad_watched_per_min' },
//                 { data: 'total_ad_watched' },
//                 { data: 'illegally_watched' },
//                 { data: 'created_at' },
//             ],
//             columnDefs:[
//                 {
//                     targets: 6,
//                     createdCell: function (td)
//                     {
//                         $(td).html('<div class="text-center btn-list">' +
//                             '<a href="{{asset(route(`dashboard`))}}" class="border-0 btn-transition btn btn-sm btn-outline-primary" title="edit"><i class="fe fe-edit"></i></a>' +
//                             '<a class="border-0 btn-transition btn btn-sm btn-outline-primary ml-5" title="show"><i class="fe fe-eye"></i></a>' +
//                             '</div>');
//                     }
//                 }
//             ]
//         }
//
//
//     );
//     // }
// } );
