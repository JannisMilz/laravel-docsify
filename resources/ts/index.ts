window.onload = function () {
    const sidebarInputs = document.querySelectorAll(".sidebar a");
    sidebarInputs.forEach((el) => {
        el.href = "/{{route}}/{{version}}" + el.href;
    });
};
