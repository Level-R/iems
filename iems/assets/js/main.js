document.addEventListener('DOMContentLoaded', function () {
    // start
    const EMailORUsername = document.getElementById('login_input');
    if (EMailORUsername) {
        EMailORUsername.addEventListener('input', ()=>{
            const value = EMailORUsername.value.trim();
            if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                EMailORUsername.type = 'email';
            } else if (/^01[3-9]\d{8}$/.test(value)) {
                EMailORUsername.type = 'text';
            } else {
                EMailORUsername.type = 'text';
            }
        });
    }
    // end

    //   sidebar Start
    const sidebar = document.getElementById("mySidebar");
    const main = document.getElementById("main");
    const toggleSidebar = document.getElementById('toggleSidebar');

    if (toggleSidebar && sidebar && main) {
        toggleSidebar.addEventListener('click', function () {
            const isCollapsed = sidebar.classList.contains('collapsed');
            const isMobile = window.innerWidth <= 768;
            if (isMobile) {
                sidebar.classList.toggle('active');
            }else {
                if (isCollapsed) {
                    // Expand sidebar
                    sidebar.classList.remove('collapsed');
                    sidebar.style.width = '250px';
                    main.style.marginLeft = '250px';
                } else {
                    // Collapse sidebar
                    sidebar.classList.add('collapsed');
                    sidebar.style.width = '90px';
                    main.style.marginLeft = '90px';
                }
            }
        });
    }
    // active side link 
const sidebarLinks = document.querySelectorAll('#mySidebar a');

// Normalize full href (including query string)
function normalizeHref(href) {
  const a = document.createElement("a");
  a.href = href;
  return a.pathname.replace(/\/+$/, "") + a.search;
}

const currentHref = normalizeHref(window.location.href);
let matchFound = false;

sidebarLinks.forEach(link => {
  const linkHref = normalizeHref(link.href);

  if (linkHref === currentHref) {
    link.classList.add("active");
    localStorage.setItem('activeSidebarLink', linkHref);
    matchFound = true;
  } else {
    link.classList.remove("active");
  }

  link.addEventListener("click", function () {
    localStorage.setItem('activeSidebarLink', normalizeHref(this.href));
  });
});

// If no match found from current location, fallback to last clicked
if (!matchFound) {
  const savedHref = localStorage.getItem('activeSidebarLink');
  sidebarLinks.forEach(link => {
    if (normalizeHref(link.href) === savedHref) {
      link.classList.add('active');
    }
  });
}
document.querySelectorAll(".sidebar-dropdown .dropdown-toggle").forEach(toggle => {
  toggle.addEventListener("click", function (e) {
    e.preventDefault();
    const parent = this.closest(".sidebar-dropdown");
    parent.classList.toggle("open");
    this.classList.toggle("dropdown_active");
  });
});
    // sidebar end
    // message id="flashMessage" start
    const flashMessage = document.getElementById('flashMessage');
    if (flashMessage) {
        setTimeout(()=>{
            flashMessage.classList.add('fade-out');
            setTimeout(()=>{
                flashMessage.remove();
                if(window.history.replaceState){
                    const url = new URL(window.location);
                    url.searchParams.delete('upload');
                    url.searchParams.delete('success');
                    url.searchParams.delete('error');
                    window.history.replaceState(null, '', url)
                }
            }, 500);
        }, 2000);
    }
    // message end
    // page reloads
    const refreshBtn = document.getElementById('refreshBtn');

    // Add a click event listener to the button
    refreshBtn.addEventListener('click', function() {
        // Change the icon to a spinning one
        refreshBtn.innerHTML = '<i class="fa fa-refresh fa-spin "></i>&nbsp; Reloading...';

        // Set a timeout to reload the page after a short delay (to let the spinning effect show)
        setTimeout(function() {
            location.reload();  // This reloads the page
        }, 1000);  // Delay for 1 second (1000 ms)
    });
    // print 
    const printBtn = document.getElementById('printBtn');
    printBtn.addEventListener('click', function(){
        window.print();
    })

    // Delete URL Update
    var deleteConfirmModal = document.getElementById('deleteConfirmModal');
    var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

  deleteConfirmModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; 
    var userId = button.getAttribute('data-user-id');
    var role = button.getAttribute('data-role');

    
    confirmDeleteBtn.href = "/iems/admin/data/user-delete-data.php?user=" + encodeURIComponent(role) + "&id=" + encodeURIComponent(userId);
  });
});
