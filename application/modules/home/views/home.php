<section class="uk-section uk-padding-remove slider-section">
  <?php if($this->wowmodule->getStatusModule('Slideshow')): ?>
  <?php if($this->home_model->getSlides()->num_rows()): ?>
  <div class="uk-position-relative uk-visible-toggle " uk-slideshow="animation: fade;autoplay: true;autoplay-interval: 6000;min-height: 150;max-height: 300;">
    <ul class="uk-slideshow-items uk-height-small-slider-home">
      <?php foreach ($slides as $slides): ?>
      <?php if ($slides->type == 1): ?>
      <li>
        <img src="<?= $template['location'].'assets/images/slides/'.$slides->route; ?>" alt="<?= $slides->title ?>" uk-cover>
        
			<div class="uk-container uk-position-large uk-position-center-left uk-margin-large-top ">
          <h2 class="uk-h2 uk-visible@m"><?= $slides->title ?></h2>
          <p class="uk-visible@m"><?= $slides->description ?></p>
        </div>
      </li>
      <?php elseif ($slides->type == 2): ?>
      <li>
        <video src="<?= $template['location'].'assets/images/slides/'.$slides->route; ?>" autoplay loop playslinline uk-cover></video>
        <div class="uk-container uk-position-large uk-position-center-left uk-margin-large-top ">
          <h2 class="uk-h2 uk-visible@m"><?= $slides->title ?></h2>
          <p class=" uk-visible@m"><?= $slides->description ?></p>
        </div>
      </li>
      <?php elseif ($slides->type == 3): ?>
      <li>
        <iframe src="<?= $slides->route; ?>" frameborder="0" allowfullscreen uk-video="autoplay: false" data-uk-cover="automute: false"></iframe>
      </li>
      <?php endif; ?>
      <?php endforeach ?>
    </ul>
    <div class="uk-position-bottom-center uk-position-small">
      <ul class="uk-slideshow-nav uk-dotnav"></ul>
    </div>
  </div>
  <?php endif ?>
  <?php endif ?>
</section>	
<section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
   <div class="uk-container">
    <div class="uk-grid uk-grid-medium uk-margin-small data-uk-grid">
      <div class="uk-width-1-3@s">
      <img
          class="uk-divider"
          src="<?= $template['location'].'assets/images/separator.png'?>"
        />  
				<a class="uk-text-decoration-none" href="page/about">
        <div class="uk-home-server">
          <h2 class="uk-h4 uk-text-bold uk-text-center"><?= $this->lang->line('section_about_title') ?></h2>
          <p class="uk-text-decoration-none uk-text-muted">
            <?= $this->lang->line('section_about_description') ?>
          </p>
        </div>
				</a>
      </div>
      <div class="uk-width-2-3@s">
				<a class="uk-text-decoration-none" href="#">
        <div class="uk-home-discord">
          <iframe width="100%" height="500" src="https://www.youtube.com/embed/th1jj-UtEGE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </a>
        </div>
    </div>
  </div>
</section>
<section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-grid uk-grid-medium uk-margin-small data-uk-grid">
      <div class="uk-width-2-3@s">
      <img
          class="uk-divider uk-margin-small-bottom"
          src="<?= $template['location'].'assets/images/separator.png'?>"
        />            
          <?php if ($this->wowmodule->getStatusModule('News')): ?>
        <h2 class="uk-h4 uk-text-bold uk-text-center">NEWS</h2>
        <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-1" data-uk-grid>
          <?php foreach ($NewsList as $news): ?>
          <div>
            <a href="<?= base_url('news/'.$news->id) ;?>" title="<?= $this->lang->line('button_read_more'); ?>">
              <div class="uk-card uk-card-default news-card uk-card-hover uk-grid-collapse uk-margin uk-home-grid" uk-grid>
                <div class="uk-width-1-3@s uk-card-media-left uk-cover-container">
                  <img src="<?= base_url('assets/images/news/'.$news->image); ?>" alt="<?= $news->title ?>" uk-cover>
                  <canvas width="500" height="250"></canvas>
                </div>
                <div class="uk-width-2-3@s uk-card-body uk-home-body">
                <hr class=" uk-home-border">
                <div>
                  <h5 class="uk-h5 uk-text-bold uk-margin-small"><?= $news->title ?></h5>
                  <p class="uk-text-small uk-margin-small"><?= mb_substr(ucfirst(strtolower(strip_tags($news->description))), 0, 160, "UTF-8").' ...'; ?></p>
                  <p class="uk-text-small uk-margin-remove uk-text-right"><i class="far fa-comment-alt"></i> <?= $this->news_model->getCommentCount($news->id); ?> <?= $this->lang->line('news_comments'); ?></p>
                </div>
              </div>
              </div>
            </a>
          </div>
          <?php endforeach ?>
        </div>
        <?php endif ?>
      </div>
      <div class="uk-width-1-3@s">
        <div class="uk-home-server">
        <?php if($this->wowmodule->getStatusModule('Realm Status')): ?>
        <h2 class="uk-h4 uk-text-bold uk-text-center">SERVER STATUS</h2>
        <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-margin-small" data-uk-grid>
          <?php foreach ($realmsList as $charsMultiRealm): 
            $multiRealm = $this->wowrealm->getRealmConnectionData($charsMultiRealm->id);
          ?>
          <div>
            <div class="uk-card uk-card-default uk-card-body card-server">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-expand">
                  <h5 class="uk-h5 uk-text-bold uk-margin-small"><a href="<?= base_url('online'); ?>" class="uk-link-reset"><i class="fas fa-server"></i> <?= $this->lang->line('table_header_realm'); ?> <?= $this->wowrealm->getRealmName($charsMultiRealm->realmID); ?></a></h5>
                </div>
                <div class="uk-width-auto">
                  <?php if ($this->wowrealm->RealmStatus($charsMultiRealm->realmID)): ?>
                    <div class="status-dot online" uk-tooltip="<?= $this->lang->line('online'); ?>"><span><span></span></span></div>
                  <?php else: ?>
                    <div class="status-dot offline" uk-tooltip="<?= $this->lang->line('offline'); ?>"><span><span></span></span></div>
                  <?php endif ?>
                </div>
              </div>
              <?php if ($this->wowrealm->RealmStatus($charsMultiRealm->realmID)): ?>
              <div class="uk-grid uk-grid-collapse uk-margin-small" data-uk-grid>
                <div class="uk-width-1-2">
                  <div class="uk-tile alliance-bar uk-text-center" uk-tooltip="<?= $this->lang->line('faction_alliance'); ?>">
                    <i class="fas fa-users"></i>
                    <?= $this->wowrealm->getCharactersOnlineAlliance($multiRealm); ?>
                  </div>
                </div>
                <div class="uk-width-1-2">
                  <div class="uk-tile horde-bar uk-text-center" uk-tooltip="<?= $this->lang->line('faction_horde'); ?>">
                    <i class="fas fa-users"></i>
                    <?= $this->wowrealm->getCharactersOnlineHorde($multiRealm); ?>
                  </div>
                </div>
              </div>
              <?php else: ?>
              <p class="uk-text-small uk-margin-small"><i class="fas fa-exclamation-circle"></i> <?= $this->lang->line('home_realm_info'); ?> <span class="uk-text-danger uk-text-bold uk-text-uppercase"><?= $this->lang->line('offline'); ?></span></p>
              <?php endif ?>
            </div>
          </div>
          <?php endforeach ?>
        </div>
        <p class="uk-h5 uk-text-center uk-margin dotted-divider">
          <?php if ($this->wowgeneral->getExpansionAction() == 1): ?>
          <i class="fas fa-gamepad"></i> Set Realmlist <?= $this->config->item('realmlist'); ?>
          <?php else: ?>
          <i class="fas fa-gamepad"></i> Set Portal "<?= $this->config->item('realmlist'); ?>"
          <?php endif ?>
        </h5>
        <?php endif ?>
        <?php if ($this->wowmodule->getStatusModule('Discord') && $this->config->item('discord_type') == '1'): ?>
        </p>
        <div class="uk-home-discord">
        <h2 class="uk-h4 uk-text-bold uk-text-center">  <i class="fab fa-discord fa-sm"></i> DISCORD</h2>
         <hr class="uk-margin-small-footer">
        <div class="uk-text-center uk-margin-small discord-body">
          <a target="_blank" class="discord-widget" href="https://discord.gg/<?= $this->config->item('discord_invitation'); ?>" title="Join us on Discord">
                        <!--<img src="https://discord.com/api/guilds/<?= $discord_id ?>/widget.png?style=<?= $this->config->item('discord_style'); ?>">      -->
            Unete ahora
            </a>
        </div>
        <?php endif ?>
        <?php if ($this->wowmodule->getStatusModule('Discord') && $this->config->item('discord_type') == '2'): ?>
        <h2 class="uk-h4 uk-text-bold uk-text-center">DISCORD</h2>
          <hr class="uk-margin-small-footer">
        <div class="uk-text-center uk-margin-small discord-body">
          <iframe src="https://discordapp.com/widget?id=<?= $discord_id ?>&theme=dark" width="300" height="300" allowtransparency="true" frameborder="0"></iframe>
        </div>
          </div>
        <?php endif ?>
      </div>
    </div>
      <img
          class="uk-divider uk-margin-medium-top uk-margin-medium-bottom"
          src="<?= $template['location'].'assets/images/separator.png'?>"
        />  
  </div>
</section>
<section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
  <div class="uk-grid uk-grid-medium uk-margin-small data-uk-grid">
    <a class="uk-services" href="page/how-to-connect">
      <div class="uk-container uk-padding-remove">
      <div class="uk-text-decoration-none uk-grid uk-margin-remove-left data-uk-grid ">
        <div class="uk-width-2-3@s uk-services-element uk-flex uk-flex-middle">
          <img
            src="<?= $template['location'].'assets/images/' . $this->lang->line('image_how_connect'); ?>"
          />     
        </div>
        <div class="uk-width-1-3@s uk-flex uk-flex-middle">
          <div class="uk-text-decoration-none">
            <h3 class="uk-h5 uk-text-bold uk-text-center"><?= $this->lang->line('section_features_title_one'); ?></h3>
            <p class="uk-text-decoration-none uk-text-center uk-text-muted">
              <?= $this->lang->line('section_features_description_one') ?>
            </p>
          </div>
        </div>
      </div>
      </div>
    </a>
    <a class="uk-services" href="page/information">
      <div class="uk-container uk-padding-remove">
        <div class="uk-text-decoration-none uk-grid uk-margin-remove-left data-uk-grid">
          <div class="uk-width-1-3@s uk-flex uk-flex-middle">
            <div class="uk-text-decoration-none">
              <h3 class="uk-h5 uk-text-bold uk-text-center"><?= $this->lang->line('section_features_title_two'); ?></h3>
              <p class="uk-text-decoration-none uk-text-center uk-text-muted">
                <?= $this->lang->line('section_features_description_two') ?>
              </p>
            </div>
          </div>
          <div class="uk-width-2-3@s uk-services-element uk-flex uk-flex-middle">
              <img 
              src="<?= $template['location'].'assets/images/' . $this->lang->line('image_information_server');?>" />    
          </div>
        </div>
      </div>
    </a>
  </div>
</section>
