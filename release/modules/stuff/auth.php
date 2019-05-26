<div class="auth-form" style="display: none;">
  <form class="form">
    <div class="form__cover"></div>
    <div class="form__loader">
      <div class="spinner active">
        <svg class="spinner__circular" viewBox="25 25 50 50">
          <circle class="spinner__path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
        </svg>
      </div>
    </div>
    <div class="form__content">
      <h1>Авторизация</h1>

      <div class="inputs">
        <label class="lblInp m-btm-40" for="mail">
          <input type="email" id="mail" required></input>
          <label for="mail">Логин</label>
          <i class="fa fa-envelope" aria-hidden="true"></i>
        </label>
        <label class="lblInp" for="password">
          <input type="password" id="password"></input>
          <label for="password">Пароль</label>
          <i class="fa fa-lock" aria-hidden="true"></i>
        </label>
      </div>

      <button type="button" class="styled-button">
        <span class="styled-button__real-text-holder">
          <span class="styled-button__real-text">Войти</span>
          <span class="styled-button__moving-block face">
            <span class="styled-button__text-holder">
              <span class="styled-button__text">Войти</span>
            </span>
          </span><span class="styled-button__moving-block back">
            <span class="styled-button__text-holder">
              <span class="styled-button__text">Войти</span>
            </span>
          </span>
        </span>
      </button>

  </form>
</div>
