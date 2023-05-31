
let mainTable;
let url;
let headers;
let data;
let userIsLoggedIn;
let advancedSearchFormToggle;
let addFormToggle;
let sort_order = "asc";
let sort_target = "name";

$(document).ready(()=>{ 
    //get table header elements and add eventisteners for sorting
    getHeaders();
    //get advanced search button and add submit button and add listener
    advancedSearchButton = document.querySelector("#advanced_search_form button.submit-form").addEventListener('click',submitAdvFilterForm);
    addButton = document.querySelector("#add_form button.add-form").addEventListener('click',submitAddForm);
    //get advanced search form element for toggle with eventlistener
    advancedSearchFormToggle = document.querySelector("#advanced_search_form .card-header");
    advancedSearchFormToggle.addEventListener('click',()=>{
	    let advancedSearchForm = document.querySelector("#advanced_search_form");
	    let addForm = document.querySelector("#add_form");
      if(advancedSearchForm.clientHeight === 45){ //form is closed, needs to open
		    advancedSearchForm.style.height = "500px";
	      if(addForm.clientHeight === 45){ addForm.style.top = "455px";}
		    if(addForm.clientHeight === 500){ advancedSearchForm.style.top = "0px";}
	  }
	    else if(advancedSearchForm.clientHeight === 500){ //form is open, needs to close
		    advancedSearchForm.style.height = "45px";
		    if(addForm.clientHeight === 45){ addForm.style.top = "0px";}
		    if(addForm.clientHeight === 500){advancedSearchForm.style.top = "455px";}
	    }
    });
    //get add form element for toggle with eventlistener
    addFormToggle = document.querySelector("#add_form .card-header");
    addFormToggle.addEventListener('click',()=>{
      let advancedSearchForm = document.querySelector("#advanced_search_form");
	    let addForm = document.querySelector("#add_form");
      if(addForm.clientHeight === 45){ //form is closed, needs to open
		    addForm.style.height = "500px";
	      if(advancedSearchForm.clientHeight === 45){ advancedSearchForm.style.top = "455px";}
		    if(advancedSearchForm.clientHeight === 500){ addForm.style.top = "0px";}
	    }
	    else if(addForm.clientHeight === 500){ //form is open, needs to close
		    addForm.style.height = "45px";
		    if(advancedSearchForm.clientHeight === 45){ advancedSearchForm.style.top = "0px";}
		    if(advancedSearchForm.clientHeight === 500){addForm.style.top = "455px";}
	    }
    });

    //get add record element for toggle
    addFormToggle = document.querySelector("#add_form .card-header");
    mainTable = $('#main-table');
    url = "get_ajax_data.php";
    loadData(mainTable, url);  
  } 
)

//submit advanced filtered form
function submitAdvFilterForm(){
  let name = document.querySelector("#advanced_search_form input.name").value;
  let surname = document.querySelector("#advanced_search_form input.surname").value;
  let email = document.querySelector("#advanced_search_form input.email").value;
  let telephone = document.querySelector("#advanced_search_form input.telephone").value;
  let address = document.querySelector("#advanced_search_form input.address").value;
  let city = document.querySelector("#advanced_search_form input.city").value;
  let country = document.querySelector("#advanced_search_form input.country").value;
  
  // send data to server
  let form_data = new FormData();

  form_data.append("id", "");
  form_data.append("name", name);
  form_data.append("surname", surname);
  form_data.append("email", email);
  form_data.append("telephone", telephone);
  form_data.append("address", address);
  form_data.append("city", city);
  form_data.append("country", country);
  form_data.append("action", "filter");

  $.ajax({
    url: url,
    type: "POST",
    data: form_data,
    processData: false,
    contentType:false,
    success: function(responce){
      console.log("filter added");
      console.log(responce);
    }
  });
}

//submit add new record form
function submitAddForm(){
  let name = document.querySelector("#add_form input.name").value;
  let surname = document.querySelector("#add_form input.surname").value;
  let email = document.querySelector("#add_form input.email").value;
  let telephone = document.querySelector("#add_form input.telephone").value;
  let address = document.querySelector("#add_form input.address").value;
  let city = document.querySelector("#add_form input.city").value;
  let country = document.querySelector("#add_form input.country").value;
  
  //send data to server
  let form_data = new FormData();

  form_data.append("id", "");
  form_data.append("name", name);
  form_data.append("surname", surname);
  form_data.append("email", email);
  form_data.append("telephone", telephone);
  form_data.append("address", address);
  form_data.append("city", city);
  form_data.append("country", country);
  form_data.append("action", "add");

  $.ajax({
    url: url,
    type: "POST",
    data: form_data,
    processData: false,
    contentType:false,
    success: function(responce){
      console.log("record added");
      console.log(responce);
      loadData();
    }
  });
};


//get table header elements and add eventisteners for sorting
function getHeaders(){
  headers = document.querySelectorAll(".table-header");
  headers.forEach(header => {
    header.addEventListener('click', (e)=> {sortData(e, e.target.getAttribute("data-sort"));});
  });
}

//sort data according to clicked element
function sortData(e, sortOrder){
 sort_target = e.target.getAttribute("data-name");
  headers.forEach(header => {
    image = header.querySelector("img");
    if(image !== null) header.removeChild(image);
    header.setAttribute("data-sort","null");
  });
  if(sortOrder == "ASC") {
    e.target.setAttribute("data-sort","DESC");
    sort_order = "desc";
    const image = document.createElement("img");
    image.src = "dist/img/sort_reversed.png";
    e.target.appendChild(image);
  }
  else{
    e.target.setAttribute("data-sort","ASC");
    sort_order = "asc";
    const image = document.createElement("img");
    image.src = "dist/img/sort.png";
    e.target.appendChild(image);
  }
  sortDataBy(sort_target, sort_order);
  populateTable();
}

function sortDataBy(property, order) {  
  if(order == "asc"){
    return data.sort((a, b) => {
      return a[property] >= b[property]
        ? 1
        : -1
    })
  }
  return data.sort((a, b) => {
    return a[property] >= b[property]
      ? -1
      : 1
  })
}


function loadData(){
  $.getJSON(url, { request:"view", id:"all", column:"all"}, (getJsonData)=>{
    data = getJsonData;
    userIsLoggedIn = data[data.length-1];
    data.splice(-1) //remove user loggedin info from data array
    console.log(data);
    console.log(data.length);
    populateTable();
  });};

function populateTable(){
  sortDataBy(sort_target, sort_order);
  mainTable.empty();
  for(let i=0; i < data.length; i++){
    const buttonView = $(`
      <button 
      data-id="${data[i].id}"
      data-state="hidden"
      data-action="view" 
      class="b-view btn btn-success m-1">
        Προβολή 
      </button>`);
    buttonView.on('click', (e)=>{buttonClicked(e, data);});
    
    let tableRow = $(`
      <tr 
        data-id="${data[i].id}"
        data-array-id="${i}">
      </tr>`
      );
    tableRow.append(`<td class="name">       ${data[i].name}       </td>`);
    tableRow.append(`<td class="surname">    ${data[i].surname}    </td>`);
    tableRow.append(`<td class="email">      ${data[i].email}      </td>`);
    tableRow.append(`<td class="telephone">  ${data[i].telephone}  </td>`);
    
    let tableDataButtons = $("<td></td>");
    tableDataButtons.append(buttonView);
    if(userIsLoggedIn){
      const buttonEdit = $(`
      <button 
        data-id="${data[i].id}" 
        data-action="edit"
        class="b-edit btn btn-info m-1">
          Επεξεργασία
        </button>`);
      buttonEdit.on('click', (e)=>{buttonClicked(e, data);});

      const buttonDelete = $(`
      <button 
        data-id="${data[i].id}"
        data-array-id="${i}"
        data-action="delete" 
        class="b-delete btn btn-danger m-1">
          Διαγραφή
        </button>`);
      buttonDelete.on('click', (e)=>{buttonClicked(e, data);});

      tableDataButtons.append(buttonEdit);
      tableDataButtons.append(buttonDelete);
    }
    tableRow.append(tableDataButtons);
    mainTable.append(tableRow);
    mainTable.append(`
    <tr 
    data-expanded-id='${data[i].id}'
    data-expanded-action='none'
    >
    </tr>
    `);
  }
}

function buttonClicked(e, data){
  const dataAction = e.target.getAttribute("data-action");
  const dataId = e.target.getAttribute("data-id");
  const trCurrent = $(`tr[data-expanded-id="${dataId}"]`);
  
  //check if tr is empty
  trIsEmpty = true;
  if(trCurrent.children().length > 0) trIsEmpty = false;
  trCurrent.empty();
  //empty tr after animation
  if(trCurrent.attr("data-expanded-action") === dataAction){
    trCurrent.attr("data-expanded-action","none");
  }
  else if(dataAction === "view"){
    trCurrent.attr("data-expanded-action","view");
    let recordObject;
    for(let i=0; i < data.length; i++){
      if(data[i].id === dataId){
        recordObject = data[i];
      }
    }
    // console.log(trCurrent);
    trCurrent.append(` 
      <td colspan="6">
      <div class="container-fluid slide-effect-${recordObject.id}">
        <div class="cntainer row d-flex justify-content-flex-start view">
        <div class="col-lg-6">
          <div class="card card-primary">
            <div class="card-header text-center">
              <h5 class="m-0">${recordObject.name} ${recordObject.surname} - αναλυτική προβολή</h5>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
              <tbody class="view">
                  <tr>
                    <th>ΟΝΟΜΑ</th>
                    <td>${recordObject.name}</td>
                  </tr>
                  <tr>
                    <th>ΕΠΩΝΥΜΟ</th>
                    <td>${recordObject.surname}</td>
                  </tr>
                  <tr>
                    <th>EMAIL</th>
                    <td>${recordObject.email}</td>
                  </tr>
                  <tr>
                    <th>ΤΗΛΕΦΩΝΟ</th>
                    <td>${recordObject.telephone}</td>
                  </tr>
                  <tr>
                    <th>ΔΙΕΥΘΥΝΣΗ</th>
                    <td>${recordObject.address}</td>
                  </tr>
                  <tr>
                    <th>ΠΟΛΗ</th>
                    <td>${recordObject.city}</td>
                  </tr>
                  <tr>
                    <th>ΧΩΡΑ</th>
                    <td>${recordObject.country}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-primary user-avatar avatar-view">
            <img src="dist/img/users/${recordObject.image}" onerror="if (this.src != 'dist/img/users/default.png') this.src = 'dist/img/users/default.png';"
          </div>
        </div>
        </div>
      </div>`
    );
    //animations
    trCurrent.css('opacity', '0');
    trCurrent.animate({opacity: 1}, 100);
    if(trIsEmpty){
      var curHeight = $(".slide-effect-" + recordObject.id).height();
      $(".slide-effect-" + recordObject.id).css('height', '0px');
      $(".slide-effect-" + recordObject.id).animate({height: curHeight}, 400);
    }
  } //buttonDataAction === "view"
  else if(dataAction === "edit"){
    trCurrent.attr("data-expanded-action","edit");
    let recordObject;
    for(let i=0; i < data.length; i++){
      if(data[i].id === dataId){
        recordObject = data[i];
      }
    }
    // console.log(trCurrent);
    trCurrent.append(` 
      <td colspan="6">
      <div class="container-fluid slide-effect-${recordObject.id}">
        <div class="cntainer row d-flex justify-content-flex-start edit">
        <div class="col-lg-6">
          <div class="card card-primary">
            <div class="card-header text-center">
              <h5 class="m-0">${recordObject.name} ${recordObject.surname} - επεξεργασία στοιχείων</h5>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
              <tbody data-id = "${recordObject.id}" class="update">
                  <tr>
                    <th><label for="name">ΟΝΟΜΑ</label></th>
                    <td><input type="text" class="form-control name" name="name" value="${recordObject.name}"></td>
                  </tr>
                  <tr>
                    <th><label for="surname">ΕΠΙΘΕΤΟ</label></th>
                    <td><input type="text" class="form-control surname" name="surname" value="${recordObject.surname}"></td>                   
                  </tr>
                  <tr>
                    <th><label for="email">EMAIL</label></th>
                    <td><input type="email" class="form-control email" name="email" value="${recordObject.email}"></td>                   
                  </tr>
                  <tr>
                    <th><label for="telephone">ΤΗΛΕΦΩΝΟ</label></th>
                    <td><input type="tel" class="form-control telephone" name="telephone" value="${recordObject.telephone}"></td>                
                  </tr>
                  <tr>
                    <th><label for="address">ΔΙΕΥΘΥΝΣΗ</label></th>
                    <td><input type="text" class="form-control address" name="address" value="${recordObject.address}"></td>
                  </tr>
                  <tr>
                    <th><label for="city">ΠΟΛΗ</label></th>
                    <td><input type="text" class="form-control city" name="city" value="${recordObject.city}"></td>                 
                  </tr>
                  <tr>
                    <th><label for="country">ΧΩΡΑ</label></th>
                    <td><input type="text" class="form-control country" name="country" value="${recordObject.country}">              
                  </td>
                  </tr>
                  <tr class="save_form">
                    <td colspan="2">
                    <button class="btn btn-info disabled btn-sm">
                      <i class="fa fa-save"></i> Αποθήκευση
                    </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-primary user-avatar avatar-edit">
            <img src="dist/img/users/${recordObject.image}" onerror="
            if (this.src != 'dist/img/users/default.png') this.src = 'dist/img/users/default.png';"
          </div>
        </div>
        </div>
      </div>`
    );
    //add listener to update button
    document.querySelector(`tbody[data-id="${recordObject.id}"] .btn-info`).addEventListener("click",()=>{updateData(recordObject)});
    //add listeners to detect when the update button should be enabled
    document.querySelectorAll(`tbody[data-id="${recordObject.id}"] input`).forEach(element =>{
      element.addEventListener('change', ()=>{
        document.querySelector(`tbody[data-id="${recordObject.id}"] .btn-info`).classList.remove("disabled");
        console.log("change");
      });
    });
  
    //animations
    trCurrent.css('opacity', '0');
    trCurrent.animate({opacity: 1}, 300);
    if(trIsEmpty){
      var curHeight = $(".slide-effect-" + recordObject.id).height();
      $(".slide-effect-" + recordObject.id).css('height', '0px');
      $(".slide-effect-" + recordObject.id).animate({height: curHeight}, 400);
    }
  } //buttonDataAction === "edit"
  else if(dataAction === "delete"){
    let form_data = new FormData();
    form_data.append("id", e.target.getAttribute("data-id"));
    form_data.append("name", "");
    form_data.append("surname", "");
    form_data.append("email", "");
    form_data.append("telephone", "");
    form_data.append("address", "");
    form_data.append("city", "");
    form_data.append("country", "");
    form_data.append("action", "delete");

    $.ajax({
      url: url,
      type: "POST",
      data: form_data,
      processData: false,
      contentType:false,
      success: function(responce){
        console.log("record deleted");
        console.log(responce);
        //remove entry from data array
        const entry = e.target.getAttribute("data-array-id");
        data.splice(entry, 1);
        $(`tr[data-array-id=${entry}]`).animate(
          { 
            opacity:  0,
            left: "100px"
          },
            300, function() {
            //repopulate table
            populateTable();
        });
      }
    });
  }  
} // end of function buttonClicked


function updateData(recordObject){
  dataId = recordObject.id;
  let name = document.querySelector(`tbody[data-id="${dataId}"] input.name`).value;
  let surname = document.querySelector(`tbody[data-id="${dataId}"] input.surname`).value;
  let email = document.querySelector(`tbody[data-id="${dataId}"] input.email`).value;
  let telephone = document.querySelector(`tbody[data-id="${dataId}"] input.telephone`).value;
  let address = document.querySelector(`tbody[data-id="${dataId}"] input.address`).value;
  let city = document.querySelector(`tbody[data-id="${dataId}"] input.city`).value;
  let country = document.querySelector(`tbody[data-id="${dataId}"] input.country`).value;
  let form_data = new FormData();

  form_data.append("id", dataId);
  form_data.append("name", name);
  form_data.append("surname", surname);
  form_data.append("email", email);
  form_data.append("telephone", telephone);
  form_data.append("address", address);
  form_data.append("city", city);
  form_data.append("country", country);
  form_data.append("action", "update");

  $.ajax({
    url: url,
    type: "POST",
    data: form_data,
    processData: false,
    contentType:false,
    success: function(responce){
      console.log(responce);
      $.getJSON(url, { request:"view", id:dataId, column:"all"}, (data)=>{
        console.log(data);

        document.querySelector(`tbody[data-id="${dataId}"] input.name`).value = data[0].name;
        document.querySelector(`tbody[data-id="${dataId}"] input.surname`).value = data[0].surname;
        document.querySelector(`tbody[data-id="${dataId}"] input.email`).value = data[0].email;
        document.querySelector(`tbody[data-id="${dataId}"] input.telephone`).value = data[0].telephone;
        document.querySelector(`tbody[data-id="${dataId}"] input.address`).value = data[0].address;
        document.querySelector(`tbody[data-id="${dataId}"] input.city`).value = data[0].city;
        document.querySelector(`tbody[data-id="${dataId}"] input.country`).value = data[0].country;
        document.querySelector(`tr[data-id="${dataId}"]>td.name`).textContent = data[0].name;
        document.querySelector(`tr[data-id="${dataId}"]>td.surname`).textContent = data[0].surname;
        document.querySelector(`tr[data-id="${dataId}"]>td.email`).textContent = data[0].email;
        document.querySelector(`tr[data-id="${dataId}"]>td.telephone`).textContent = data[0].telephone;
        recordObject.name = data[0].name;
        recordObject.surname = data[0].surname;
        recordObject.email = data[0].email;
        recordObject.telephone = data[0].telephone;
        recordObject.address = data[0].address;
        recordObject.city = data[0].city;
        recordObject.country = data[0].country;
        document.querySelector(`tbody[data-id="${recordObject.id}"] .btn-info`).classList.add("disabled");
      });
    }
  })
};