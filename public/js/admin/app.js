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
    showDropdown1('toggleDropdown', 'itemDropdown', 'dropdownIcon', 'nav-bar')

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
const inputPinjaman = document.getElementById('inputPinjaman');
const optionPinjaman = document.getElementById('optionPinjaman');
const stokInput = document.getElementById('stok');
const deskripsiBahan = document.getElementById('deskripsiBahan');

inputPinjaman.addEventListener('focus', function () {
  optionPinjaman.style.display = 'block';
  inputPinjaman.style.borderRadius = "5px 5px 0 0";
});

inputPinjaman.addEventListener('focusout', function() {
    setTimeout(() => {
      optionPinjaman.style.display = 'none';
      inputPinjaman.style.borderRadius = '5px';
    }, 100);
  });

inputPinjaman.addEventListener('input', function () {
  const value = this.value.toLowerCase();
  const options = optionPinjaman.querySelectorAll('option');
  options.forEach(option => {
    const text = option.value.toLowerCase();
    if (text.includes(value)) {
      option.style.display = 'block';
    } else {
      option.style.display = 'none';
    }
  });
});

  optionPinjaman.addEventListener('click', function (event) {
    inputPinjaman.value = event.target.value;
    optionPinjaman.style.display = 'none';
    inputPinjaman.style.borderRadius = "5px";
    if(event.target.getAttribute('data-stok') && event.target.getAttribute('data-deskripsi')){
        stokInput.value = event.target.getAttribute('data-stok');
    deskripsiBahan.value = event.target.getAttribute('data-deskripsi');
    }
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
    }, 200);
  });

guru.addEventListener('input', function() {
  const value = this.value.toLowerCase();
  const options = namaGuru.querySelectorAll('option');

  options.forEach(option => {
    const text = option.value.toLowerCase();
    if(text.includes(value)){
      option.style.display = 'block';
    } else {
      option.style.display = 'none';
    }
  })
});

  namaGuru.addEventListener('click', function (event) {
    guru.value = event.target.value;
    namaGuru.style.display = 'none';
    namaGuru.style.borderRadius = "5px";
  });



