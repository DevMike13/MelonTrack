{{-- @if (request()->is('ibroccogreens-admin/register'))
  <div class="illustration-wrapper">
    <img src="{{ asset('images/pana.png') }}" alt="" class="left-illustration-registration">
  </div>
@else
  <div class="illustration-wrapper">
    <img src="{{ asset('images/Illustration-1.png') }}" alt="" class="left-illustration-login">
  </div>
@endif --}}




<div class="illustration-wrapper">
  @if (request()->is('ibroccogreens-admin/register'))
      <img src="{{ asset('images/register-image.png') }}" alt="" class="left-illustration-registration illustration-image">
  @else
      <img src="{{ asset('images/login-image.png') }}" alt="" class="left-illustration-login illustration-image">
  @endif

  <div class="back-home-wrapper">
    <a href="{{ url('/') }}" class="back-home-btn">← Back to Home</a>
  </div>

 

  @for ($i = 0; $i < 20; $i++)
      <img
          src="{{ asset('images/micro-leaf.png') }}"
          class="broccoli near-illustration"
          style="
              left: {{ rand(0, 100) }}%;
              animation-delay: {{ rand(0, 5000) / 1000 }}s;
              animation-duration: {{ rand(3000, 7000) / 1000 }}s;
              width: {{ rand(20, 50) }}px;
          "
      />
  @endfor
</div>
{{-- <div class="back-home-wrapper-m">
  <a href="{{ url('/') }}" class="back-home-btn-m">←</a>
</div> --}}


<style>
body {
    height: 100vh;
    overflow: hidden;
    background: linear-gradient(0deg, #e5e7eb 0%, rgba(229, 231, 235, 0) 100%) !important;
    position: relative;
}

.left-illustration-login,
.left-illustration-registration {
  display: none;
}
/* @media screen and (max-width: 1023px) {
  .custom-terms-button-input {
    margin-left: -90px !important;
    margin-top: 2px !important;
    display: inline-block;
  }
} */


@media screen and (min-width: 1024px) {
    main {
      position: absolute; right: 100px;
    
    }
    .custom-tems-button-input{
      margin-left: -99px !important;
      margin-top: 1.5px;
    }
    .illustration-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 50%;
        height: 100vh;
        overflow: hidden;
        z-index: 1;
        pointer-events: none;
    }

    .illustration-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        height: auto;
        z-index: 2;
        /* border-radius: 200px; */
        pointer-events: auto;
    }

    .left-illustration-login,
    .left-illustration-registration {
        display: block;
        /* position: relative;
        width: 100%; */
        z-index: 2;
    }

    .broccoli {
        position: absolute;
        top: -100px;
        animation: drop-broccoli 5s linear infinite;
        opacity: 0.9;
        z-index: 0;
        pointer-events: none;
    }
    /* .back-home-wrapper-m{
      display: none;
    }
    .back-home-btn{
      display: none;
    } */
    .back-home-wrapper {
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translate(-50%, -50%);
      pointer-events: auto;
    }

    .back-home-btn {
        display: inline-block;
        padding: 10px 20px;
        background-color: #10b981;
        color: white;
        font-weight: 600;
        text-decoration: none;
        border-radius: 100px;
        transition: background 0.3s ease;
        pointer-events: auto;
    }

    .back-home-btn:hover {
        background-color: #059669;
    }

}
    
.broccoli {
  position: absolute;
  top: -100px;
  width: 40px;
  animation: drop-broccoli 5s linear infinite;
  z-index: -1;
  opacity: 0.9;
}
@media screen and (max-width: 1023px) {
  .custom-tems-button-input {
      margin-left: -200px !important;
      margin-top: 3px !important;
  }
  .back-home-wrapper {
      position: absolute;
      bottom: -15px;
      left: 50%;
      transform: translate(-50%, -50%);
      pointer-events: auto;
    }
}
.back-home-btn {
      display: inline-block;
      padding: 10px 20px;
      background-color: #10b981;
      color: white;
      font-weight: 600;
      text-decoration: none;
      border-radius: 100px;
      transition: background 0.3s ease;
      pointer-events: auto;
  }

  .back-home-btn:hover {
      background-color: #059669;
  }
/* Additional clones for effect */
/* .broccoli::before,
.broccoli::after {
    content: '';
    background-image: url('{{ asset('images/broccoli.svg') }}');
    background-size: contain;
    background-repeat: no-repeat;
    position: absolute;
    width: 40px;
    height: 40px;
    opacity: 0.6;
    animation: drop-broccoli 7s linear infinite;
} */

/* @media screen and (max-width: 1023px) {

  .back-home-wrapper{
    display: none
  }
  .back-home-btn{
    display: none;
  }
  .back-home-wrapper-m {
    position: fixed;
    bottom: 20px;  
    right: 20px;
    pointer-events: auto;
    z-index: 9999; 
  }

  .back-home-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    padding: 0;
    font-size: 22px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #10b981;
    color: white;
    font-weight: 600;
    text-decoration: none;
  }
} */

/* Animation */
@keyframes drop-broccoli {
    0% {
        transform: translateY(-100px) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateY(110vh) rotate(360deg);
        opacity: 0;
    }
}
</style>