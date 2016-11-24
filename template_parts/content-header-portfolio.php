<header class="page-header__menu">
  <div class="container">
    <div class="logo">
      <a href="/">UI</a>
    </div>
    <nav class="nav">
      <div class="nav-collapse">
        <ul>
          <li>
            <a class="link" href="/">Home</a>
          </li>
          <li>
            <a class="link" href="case_studies.html">Case studies</a>
          </li>
        </ul>
      </div>
      <a href="#" class="contact">
          <i class="icon"></i><span>Contact us</span>
      </a>
    </nav>
  </div>
</header><!--header end-->
<section class="page-header__portfolio">
  <div class="container_fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="page-header__portfolio__our_works">
          <div class="middle_text">
            <?php if (function_exists('ui_breadcrumbs')) ui_breadcrumbs(); ?>
            <h1 class="text-center"><?php echo get_the_title(); ?></h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
