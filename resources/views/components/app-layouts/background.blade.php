<style>
  body::after {
      content: "";
      background: url('{{ asset("imgs/background_1920.jpg") }}');
      opacity: 0.3;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
      position: fixed;
      z-index: -1;
      background-position: center;
      background-size: cover;
      background-attachment: fixed;
  }
</style>