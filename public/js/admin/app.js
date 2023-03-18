document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)

    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
    toggle.addEventListener('click', ()=>{
    // show navbar
    nav.classList.toggle('show')
    // change icon
    toggle.classList.toggle('fa-circle-xmark')
    // add padding to body
    bodypd.classList.toggle('body-pd')
    // add padding to header
    headerpd.classList.toggle('body-pd')
    })
    }
    }

    showNavbar('header-toggle','nav-bar','body-pd','header')
    });

document.addEventListener("DOMContentLoaded", function(event) {
    const showDropdown1 = (toggleId, dropdownId, dropdownIconId) => {
        const toggle = document.getElementById(toggleId),
        item = document.getElementById(dropdownId),
        icon = document.getElementById(dropdownIconId)

        if(toggle && item && icon){
            toggle.addEventListener('click', () => {
                item.classList.toggle('item-show')

                toggle.classList.toggle('active');

                icon.classList.toggle('bxs-up-arrow')
            })
        }
    }
    showDropdown1('toggleDropdown', 'itemDropdown', 'dropdownIcon')

    const showDropdown2 = (toggleId, dropdownId, dropdownIconId) => {
        const toggle = document.getElementById(toggleId),
        item = document.getElementById(dropdownId),
        icon = document.getElementById(dropdownIconId)

        if(toggle && item && icon){
            toggle.addEventListener('click', () => {
                item.classList.toggle('item-show')

                toggle.classList.toggle('active');

                icon.classList.toggle('bxs-up-arrow')
            })
        }
    }

    showDropdown2('toggleDropdown2', 'itemDropdown2', 'dropdownIcon2')
})

// DATALIST PINJAMBARANG
const barang = document.getElementById('inputNama_barang');
const nama_barang = document.getElementById('optionNama_barang');

barang.addEventListener('focus', function () {
  nama_barang.style.display = 'block';
  barang.style.borderRadius = "5px 5px 0 0";
});

barang.addEventListener('focusout', function() {
    setTimeout(() => {
      nama_barang.style.display = 'none';
      barang.style.borderRadius = '5px';
    }, 100);
  });

  nama_barang.addEventListener('click', function (event) {
    barang.value = event.target.value;
    nama_barang.style.display = 'none';
    barang.style.borderRadius = "5px";
  });


//   DATALIST GURU
const guru = document.getElementById('inputNama_guru');
const namaGuru = document.getElementById('optionNama_guru');

guru.addEventListener('focus', function () {
    namaGuru.style.display = 'block';
  guru.style.borderRadius = "5px 5px 0 0";
});

guru.addEventListener('focusout', function() {
    setTimeout(() => {
        namaGuru.style.display = 'none';
      guru.style.borderRadius = '5px';
    }, 100);
  });

  namaGuru.addEventListener('click', function (event) {
    guru.value = event.target.value;
    namaGuru.style.display = 'none';
    namaGuru.style.borderRadius = "5px";
  });