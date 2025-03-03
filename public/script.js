const submit_btn = document.getElementById("submit");
const data_table = document.getElementById("data");

async function get_transaction_user(form){
  if (form.checkValidity()) {
    // Преобразуем FormData в URL-кодированную строку
    const params = new URLSearchParams(new FormData(form)).toString();
    // Отправляем GET-запрос с помощью fetch
    fetch(`/public/data.php?${params}`, {
      method: 'GET'
  })
  .then(response => response.text())
  .then(data => {
      // Обрабатываем ответ от сервера
      if (data != "NO"){
        console.log();
        document.getElementById("h2_head"). innerHTML = "Transactions of \
          " + document.getElementById('user').selectedOptions[0].innerText;
        document.getElementById("body_data").innerHTML = data;
      }else{
        document.getElementById("body_data").innerHTML = '';
      }
  })
  .catch(error => {
      console.error('Ошибка:', error);
  });
  }
}
submit_btn.onclick = function (e) {
  e.preventDefault();
  data_table.style.display = "block";

  // TODO: implement
  const form = document.getElementById("user_form");
  get_transaction_user(form);
};
