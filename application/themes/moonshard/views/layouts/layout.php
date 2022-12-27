<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= $this->config->item('website_name'); ?> - <?= $pagetitle ?>
    </title>
    <?= $template['metadata']; ?>
    <link
      rel="icon"
      type="image/x-icon"
      href="<?= $template['location'].'assets/images/logo.png'; ?>"
    />
    <link
      rel="stylesheet"
      href="<?= $template['assets'].'core/uikit/css/uikit.min.css'; ?>"
    />
    <link
      rel="stylesheet"
      href="<?= $template['location'].'assets/css/main.css'; ?>"
    />
    <script src="<?= $template['assets'].'core/uikit/js/uikit.min.js'; ?>"></script>
    <script src="<?= $template['assets'].'core/uikit/js/uikit-icons.min.js'; ?>"></script>
    <?php if ($this->wowmodule->getStatusModule('reCaptcha')) { ?>
      <script src="https://www.google.com/recaptcha/api.js?render=<?php echo RECAPTCHA_SITE_KEY; ?>"></script>
      <script>
        grecaptcha.ready(function() {
          grecaptcha.execute('<?php echo RECAPTCHA_SITE_KEY; ?>', {action: 'form_submission'}).then(function(token) {
            document.querySelector('.g-recaptcha-response').value = token;
          });
        });
      </script>
    <?php } ?> 
  </head>
  <body>
    <div class="uk-navbar-container uk-navbar-transparent">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar>
          <?php if ($this->wowauth->isLogged()): ?>

          <div class="uk-navbar-left"></div>

          <?php else: ?>
          <div class="">
            <div class="uk-text-center">
              <a
                target="_blank"
                href="<?= $this->config->item('social_facebook'); ?>"
                class="uk-icon-button uk-margin-small-right"
                ><i class="fab fa-facebook-f"></i
              ></a>
              <a
                target="_blank"
                href="<?= $this->config->item('social_telegram'); ?>"
                class="uk-icon-button uk-margin-small-right"
                ><i class="fab fa-telegram"></i
              ></a>
              <a
                target="_blank"
                href="<?= $this->config->item('social_youtube'); ?>"
                class="uk-icon-button"
                ><i class="fab fa-youtube"></i
              ></a>
            </div>
          </div>

          <?php endif; ?>

          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <?php if (!$this->wowauth->isLogged()): ?>
              <?php if($this->wowmodule->getStatusModule('Register')): ?>
              <li class="uk-visible@m">
                <a href="<?= base_url('register'); ?>"
                  ><i class="fas fa-user-plus"></i
                  >&nbsp;<?= $this->lang->line('button_register'); ?></a
                >
              </li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Login')): ?>
              <li class="uk-visible@m">
                <a href="<?= base_url('login'); ?>"
                  ><i class="fas fa-sign-in-alt"></i
                  >&nbsp;<?= $this->lang->line('button_login'); ?></a
                >
              </li>
              <?php endif; ?>
              <?php endif; ?>
              <?php if ($this->wowauth->isLogged()): ?>
              <li class="uk-visible@m">
                <a href="#">
                  <?php if($this->wowgeneral->getUserInfoGeneral($this->session->userdata('wow_sess_id'))->num_rows()):
                  ?>
                  <img
                    class="uk-border-circle"
                    src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($this->session->userdata('wow_sess_id')))); ?>"
                    width="30"
                    height="30"
                    alt="Avatar"
                  />
                  <?php else: ?>
                  <img
                    class="uk-border-circle"
                    src="<?= base_url('assets/images/profiles/default.png'); ?>"
                    width="30"
                    height="30"
                    alt="Avatar"
                  />
                  <?php endif; ?>
                  <span class="uk-text-middle uk-text-bold"
                    >&nbsp;<?= $this->session->userdata('blizz_sess_username');
                    ?>&nbsp;<i class="fas fa-caret-down"></i
                  ></span>
                </a>
                <div
                  class="uk-navbar-dropdown"
                  uk-dropdown="boundary: .uk-container"
                >
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php if ($this->wowauth->isLogged()): ?>
                    <?php if($this->wowmodule->getStatusModule('User Panel')): ?>
                    <li class="uk-navbar-dropdown-li">
                      <a href="<?= base_url('panel'); ?>"
                        ><i class="far fa-user-circle"></i>
                        <?= $this->lang->line('button_user_panel'); ?></a
                      >
                    </li>
                    <?php endif; ?>
                    <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id'))
                    >= config_item('mod_access_level')): ?>
                    <li class="uk-navbar-dropdown-li">
                      <a href="<?= base_url('mod'); ?>"
                        ><i class="fas fa-gavel"></i>
                        <?= $this->lang->line('button_mod_panel'); ?></a
                      >
                    </li>
                    <?php endif; ?>
                    <?php if($this->wowmodule->getStatusModule('Admin Panel')): ?>
                    <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id'))
                    >= config_item('admin_access_level')): ?>
                    <li class="uk-navbar-dropdown-li">
                      <a href="<?= base_url('admin'); ?>"
                        ><i class="fas fa-cog"></i>
                        <?= $this->lang->line('button_admin_panel'); ?></a
                      >
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <li>
                      <a href="<?= base_url('logout'); ?>"
                        ><i class="fas fa-sign-out-alt"></i>
                        <?= $this->lang->line('button_logout'); ?></a
                      >
                    </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </li>
              <li class="uk-text-center">
                <a href="#">
                  <div class="uk-badge">
                    <i class="fas fa-shopping-cart"></i>
                  </div>
                  &nbsp;<span><?= $this->cart->total_items() ?></span></a
                >
                <div
                  class="uk-navbar-dropdown"
                  uk-dropdown="boundary: .uk-container"
                >
                  <div class="blizzcms-cart-dropdown">
                    <?php if($this->cart->total_items() > 0): ?>
                    <p class="uk-text-center uk-margin-small">
                      <?= $this->lang->line('store_cart_added'); ?>
                      <span class="uk-text-bold"
                        ><?= $this->cart->total_items() ?>
                        <?= $this->lang->line('table_header_items'); ?></span
                      >
                      <?= $this->lang->line('store_cart_in_your'); ?>
                    </p>
                    <a
                      href="<?= base_url('cart'); ?>"
                      class="uk-button uk-button-default uk-button-small uk-width-1-1"
                      ><i class="fas fa-eye"></i>
                      <?= $this->lang->line('button_view_cart'); ?></a
                    >
                    <?php else: ?>
                    <p class="uk-text-center uk-margin-remove">
                      <?= $this->lang->line('store_cart_no_items'); ?>
                    </p>
                    <?php endif; ?>
                  </div>
                </div>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <?php if ($this->wowauth->isLogged()): ?>
    <div class="uk-navbar-container">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar="mode: click">
          <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
              <?php foreach ($this->wowgeneral->getMenu()->result() as
              $menulist): ?>
              <?php if($menulist->main == '2'): ?>
              <li class="uk-visible@m uk-visible-logo-nav">
                <a href="<?= base_url(); ?>">
                  <img
                    class="uk-visible-logo"
                    src="<?= $template['location'].'assets/images/logo.png'?>"
                  />
                </a>
              </li>
              <li class="uk-visible@m">
                <a href="#">
                  <i class="<?= $menulist->icon ?>"></i
                  >&nbsp;&nbsp;<?= $menulist->name ?>&nbsp;&nbsp;<i
                    class="fas fa-caret-down"
                  ></i>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php foreach ($this->wowgeneral->getMenuChild($menulist->id)->result()
                    as $menuchildlist): ?>
                    <li>
                      <?php if($menuchildlist->type == '1'): ?>
                      <a href="<?= base_url($menuchildlist->url); ?>">
                        <i class="<?= $menuchildlist->icon ?>"></i
                        >&nbsp;&nbsp;<?= $menuchildlist->name ?>
                      </a>
                      <?php elseif($menuchildlist->type == '2'): ?>
                      <a target="_blank" href="<?= $menuchildlist->url ?>">
                        <i class="<?= $menuchildlist->icon ?>"></i
                        >&nbsp;&nbsp;<?= $menuchildlist->name ?>
                      </a>
                      <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </li>
              <?php elseif($menulist->main == '1' && $menulist->child == '0'):
              ?>
              <li class="uk-visible@m uk-visible-li">
                <?php if($menulist->type == '1'): ?>
                <a href="<?= base_url($menulist->url); ?>">
                  <i class="<?= $menulist->icon ?>"></i
                  >&nbsp;&nbsp;<?= $menulist->name ?>
                </a>
                <?php elseif($menulist->type == '2'): ?>
                <a target="_blank" href="<?= $menulist->url ?>">
                  <i class="<?= $menulist->icon ?>"></i
                  >&nbsp;&nbsp;<?= $menulist->name ?>
                </a>
                <?php endif; ?>
              </li>
              <?php endif; ?>
              <?php endforeach; ?>
            </ul>
            <a
              class="uk-navbar-toggle uk-hidden@m"
              uk-navbar-toggle-icon
              href="#mobile"
              uk-toggle
            ></a>
          </div>
          <div class="uk-navbar-right">
            <?php if ($this->wowauth->isLogged()): ?>
            <div class="uk-navbar-item">
              <ul class="uk-subnav uk-subnav-divider subnav-points">
                <li>
                  <span
                    uk-tooltip="title:<?=$this->lang->line('panel_dp'); ?>;pos: bottom"
                    ><i class="dp-icon"></i
                  ></span>
                  <?= $this->wowgeneral->getCharDPTotal($this->session->userdata('wow_sess_id'));
                  ?>
                </li>
                <li>
                  <span
                    uk-tooltip="title:<?=$this->lang->line('panel_vp'); ?>;pos: bottom"
                    ><i class="vp-icon"></i
                  ></span>
                  <?= $this->wowgeneral->getCharVPTotal($this->session->userdata('wow_sess_id'));
                  ?>
                </li>
              </ul>
            </div>
            <?php endif; ?>
          </div>
        </nav>
        <div id="mobile" data-uk-offcanvas="flip: true">
          <div class="uk-offcanvas-bar">
            <button class="uk-offcanvas-close" type="button" uk-close></button>
            <div class="uk-panel">
              <a
                href="<?= base_url(); ?>"
                class="uk-logo uk-text-center uk-margin-small"
                ><?= $this->config->item('website_name'); ?></a
              >
              <?php if ($this->wowauth->isLogged()): ?>
              <div
                class="uk-padding-small uk-padding-remove-vertical uk-margin-small uk-text-center"
              >
                <?php if($this->wowgeneral->getUserInfoGeneral($this->session->userdata('wow_sess_id'))->num_rows()):
                ?>
                <img
                  class="uk-border-circle"
                  src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($this->session->userdata('wow_sess_id')))); ?>"
                  width="36"
                  height="36"
                  alt="Avatar"
                />
                <?php else: ?>
                <img
                  class="uk-border-circle"
                  src="<?= base_url('assets/images/profiles/default.png'); ?>"
                  width="36"
                  height="36"
                  alt="Avatar"
                />
                <?php endif; ?>
                <span class="uk-label"
                  ><?= $this->session->userdata('blizz_sess_username'); ?></span
                >
              </div>
              <?php endif; ?>
              <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <?php if (!$this->wowauth->isLogged()): ?>
                <?php if($this->wowmodule->getStatusModule('Register')): ?>
                <li>
                  <a href="<?= base_url('register'); ?>"
                    ><i class="fas fa-user-plus"></i>
                    <?= $this->lang->line('button_register'); ?></a
                  >
                </li>
                <?php endif; ?>
                <?php if($this->wowmodule->getStatusModule('Login')): ?>
                <li>
                  <a href="<?= base_url('login'); ?>"
                    ><i class="fas fa-sign-in-alt"></i>
                    <?= $this->lang->line('button_login'); ?></a
                  >
                </li>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ($this->wowauth->isLogged()): ?>
                <?php if($this->wowmodule->getStatusModule('User Panel')): ?>
                <li>
                  <a href="<?= base_url('panel'); ?>"
                    ><i class="far fa-user-circle"></i>
                    <?= $this->lang->line('button_user_panel'); ?></a
                  >
                </li>
                <?php endif; ?>
                <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id'))
                >= config_item('mod_access_level')): ?>
                <li>
                  <a href="<?= base_url('mod'); ?>"
                    ><i class="fas fa-gavel"></i>s
                    <?= $this->lang->line('button_mod_panel'); ?></a
                  >
                </li>
                <?php endif; ?>
                <?php if($this->wowmodule->getStatusModule('Admin Panel')): ?>
                <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id'))
                >= config_item('admin_access_level')): ?>
                <li>
                  <a href="<?= base_url('admin'); ?>"
                    ><i class="fas fa-cog"></i>
                    <?= $this->lang->line('button_admin_panel'); ?></a
                  >
                </li>
                <?php endif; ?>
                <?php endif; ?>
                <li>
                  <a href="<?= base_url('logout'); ?>"
                    ><i class="fas fa-sign-out-alt"></i>
                    <?= $this->lang->line('button_logout'); ?></a
                  >
                </li>
                <?php endif; ?>
                <?php foreach ($this->wowgeneral->getMenu()->result() as
                $menulist): ?>
                <?php if($menulist->main == '2'): ?>
                <li class="uk-parent">
                  <a href="#">
                    <i class="<?= $menulist->icon ?>"></i
                    >&nbsp;<?= $menulist->name ?>
                  </a>
                  <ul class="uk-nav-sub">
                    <?php foreach ($this->wowgeneral->getMenuChild($menulist->id)->result()
                    as $menuchildlist): ?>
                    <li>
                      <?php if($menuchildlist->type == '1'): ?>
                      <a href="<?= base_url($menuchildlist->url); ?>">
                        <i class="<?= $menuchildlist->icon ?>"></i
                        >&nbsp;<?= $menuchildlist->name ?>
                      </a>
                      <?php elseif($menuchildlist->type == '2'): ?>
                      <a target="_blank" href="<?= $menuchildlist->url ?>">
                        <i class="<?= $menuchildlist->icon ?>"></i
                        >&nbsp;<?= $menuchildlist->name ?>
                      </a>
                      <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                  </ul>
                </li>
                <?php elseif($menulist->main == '1' && $menulist->child == '0'):
                ?>
                <li>
                  <?php if($menulist->type == '1'): ?>
                  <a href="<?= base_url($menulist->url); ?>">
                    <i class="<?= $menulist->icon ?>"></i
                    >&nbsp;<?= $menulist->name ?>
                  </a>
                  <?php elseif($menulist->type == '2'): ?>
                  <a target="_blank" href="<?= $menulist->url ?>">
                    <i class="<?= $menulist->icon ?>"></i
                    >&nbsp;<?= $menulist->name ?>
                  </a>
                  <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php else: ?>
    <div class="uk-navbar-container-in uk-navbar-container-bottom">
      <div class="uk-navbar-in">
        <div class="uk-container">
          <nav class="uk-navbar-menu">
            <div class="">
              <ul class="uk-navbar-nav">
                <li class="uk-visible@m">
                  <a href="<?= base_url(); ?>"><?= $this->lang->line('tab_home'); ?></a>
                </li>
                <li class="uk-visible-li uk-visible@m">
                  <a href="<?= base_url('forum'); ?>"><?= $this->lang->line('tab_forum'); ?></a>
                </li>
                <li class="uk-visible-li uk-visible@m">
                  <a href="<?= base_url('page/how-to-connect'); ?>"><?= $this->lang->line('tab_how_connect'); ?></a>
                </li>
              </ul>
            </div>
            <div class="uk-visible-logo-in uk-visible@m">
              <a href="<?= base_url(); ?>">
                <img
		src="<?= base_url(); ?>application/themes/moonshard/assets/images/logo.png"
                />
              </a>
            </div>
            <div class="">
              <ul class="uk-navbar-nav">
                <li class="uk-visible@m">
                  <a href="<?= base_url('store');?>"><?= $this->lang->line('tab_store'); ?></a>
                </li>
                <li class="uk-visible-li uk-visible@m">
                  <a href="<?= base_url('armory');?>"><?= $this->lang->line('tab_armory'); ?></a>
                </li>
                <li class="uk-visible-li uk-visible@m">
                  <a href="<?= base_url('online');?>"><?= $this->lang->line('tab_online'); ?></a>
              </ul>
            </div>
            <a
              class="uk-navbar-toggle uk-hidden@m"
              uk-navbar-toggle-icon
              href="#mobile"
              uk-toggle
            ></a>
          </nav>
          <div id="mobile" data-uk-offcanvas="flip: true">
            <div class="uk-offcanvas-bar">
              <button
                class="uk-offcanvas-close"
                type="button"
                uk-close
              ></button>
              <div class="uk-panel">
                <a
                  href="<?= base_url(); ?>"
                  class="uk-logo uk-text-center uk-margin-small"
                  ><?= $this->config->item('website_name'); ?></a
                >
                <?php if ($this->wowauth->isLogged()): ?>
                <div
                  class="uk-padding-small uk-padding-remove-vertical uk-margin-small uk-text-center"
                >
                  <?php if($this->wowgeneral->getUserInfoGeneral($this->session->userdata('wow_sess_id'))->num_rows()):
                  ?>
                  <img
                    class="uk-border-circle"
                    src="<?= base_url('assets/images/profiles/'.$this->wowauth->getNameAvatar($this->wowauth->getImageProfile($this->session->userdata('wow_sess_id')))); ?>"
                    width="36"
                    height="36"
                    alt="Avatar"
                  />
                  <?php else: ?>
                  <img
                    class="uk-border-circle"
                    src="<?= base_url('assets/images/profiles/default.png'); ?>"
                    width="36"
                    height="36"
                    alt="Avatar"
                  />
                  <?php endif; ?>
                  <span class="uk-label"
                    ><?= $this->session->userdata('blizz_sess_username');
                    ?></span
                  >
                </div>
                <?php endif; ?>
                <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                  <?php if (!$this->wowauth->isLogged()): ?>
                  <?php if($this->wowmodule->getStatusModule('Register')): ?>
                  <li>
                    <a href="<?= base_url('register'); ?>"
                      ><i class="fas fa-user-plus"></i>
                      <?= $this->lang->line('button_register'); ?></a
                    >
                  </li>
                  <?php endif; ?>
                  <?php if($this->wowmodule->getStatusModule('Login')): ?>
                  <li>
                    <a href="<?= base_url('login'); ?>"
                      ><i class="fas fa-sign-in-alt"></i>
                      <?= $this->lang->line('button_login'); ?></a
                    >
                  </li>
                  <?php endif; ?>
                  <?php endif; ?>
                  <?php if ($this->wowauth->isLogged()): ?>
                  <?php if($this->wowmodule->getStatusModule('User Panel')): ?>
                  <li>
                    <a href="<?= base_url('panel'); ?>"
                      ><i class="far fa-user-circle"></i>
                      <?= $this->lang->line('button_user_panel'); ?></a
                    >
                  </li>
                  <?php endif; ?>
                  <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id'))
                  >= config_item('mod_access_level')): ?>
                  <li>
                    <a href="<?= base_url('mod'); ?>"
                      ><i class="fas fa-gavel"></i>s
                      <?= $this->lang->line('button_mod_panel'); ?></a
                    >
                  </li>
                  <?php endif; ?>
                  <?php if($this->wowmodule->getStatusModule('Admin Panel')): ?>
                  <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id'))
                  >= config_item('admin_access_level')): ?>
                  <li>
                    <a href="<?= base_url('admin'); ?>"
                      ><i class="fas fa-cog"></i>
                      <?= $this->lang->line('button_admin_panel'); ?></a
                    >
                  </li>
                  <?php endif; ?>
                  <?php endif; ?>
                  <li>
                    <a href="<?= base_url('logout'); ?>"
                      ><i class="fas fa-sign-out-alt"></i>
                      <?= $this->lang->line('button_logout'); ?></a
                    >
                  </li>
                  <?php endif; ?>
                  <?php foreach ($this->wowgeneral->getMenu()->result() as
                  $menulist): ?>
                  <?php if($menulist->main == '2'): ?>
                  <li class="uk-parent">
                    <a href="#">
                      <i class="<?= $menulist->icon ?>"></i
                      >&nbsp;<?= $menulist->name ?>
                    </a>
                    <ul class="uk-nav-sub">
                      <?php foreach ($this->wowgeneral->getMenuChild($menulist->id)->result()
                      as $menuchildlist): ?>
                      <li>
                        <?php if($menuchildlist->type == '1'): ?>
                        <a href="<?= base_url($menuchildlist->url); ?>">
                          <i class="<?= $menuchildlist->icon ?>"></i
                          >&nbsp;<?= $menuchildlist->name ?>
                        </a>
                        <?php elseif($menuchildlist->type == '2'): ?>
                        <a target="_blank" href="<?= $menuchildlist->url ?>">
                          <i class="<?= $menuchildlist->icon ?>"></i
                          >&nbsp;<?= $menuchildlist->name ?>
                        </a>
                        <?php endif; ?>
                      </li>
                      <?php endforeach; ?>
                    </ul>
                  </li>
                  <?php elseif($menulist->main == '1' && $menulist->child ==
                  '0'): ?>
                  <li>
                    <?php if($menulist->type == '1'): ?>
                    <a href="<?= base_url($menulist->url); ?>">
                      <i class="<?= $menulist->icon ?>"></i
                      >&nbsp;<?= $menulist->name ?>
                    </a>
                    <?php elseif($menulist->type == '2'): ?>
                    <a target="_blank" href="<?= $menulist->url ?>">
                      <i class="<?= $menulist->icon ?>"></i
                      >&nbsp;<?= $menulist->name ?>
                    </a>
                    <?php endif; ?>
                  </li>
                  <?php endif; ?>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php endif; ?>

    <?= $template['body']; ?>

    <section class="uk-section uk-section-footer uk-section-xsmall">
      <div class="uk-container uk-container-footer">
        <div class="uk-height-footer">
          <img src="<?= $template['location'].'assets/images/footer.png'?>"
          />
        </div>
        <hr class="uk-margin-small-footer" />
      </div>
      <div class="uk-container">
        <p class="uk-text-center uk-margin-small">
          Copyright
          <?= date('Y'); ?>
          Theme
          <span class="uk-text-bold"
            ><?= $this->config->item('website_name'); ?></span
          > Code <span class="uk-text-bold">BlizzCMS</span>.
          <?= $this->lang->line('footer_rights'); ?>
        </p>
        <p class="uk-text-small uk-margin-small uk-text-center">
          World of Warcraft &#174; and Blizzard Entertainment &#174; are all
          trademarks or registered trademarks of Blizzard Entertainment in the
          United States and/or other countries. These terms and all related
          materials, logos, and images are copyright &#169; Blizzard
          Entertainment. This site is in no way associated with or endorsed by
          Blizzard Entertainment &#174;.
        </p>
      </div>
    </section>
  </body>
</html>
