    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small-slider header-section-changelogs"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section-slider" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <img class="uk-divider-container uk-align-center" src="<?= $template['location'] . 'assets/images/separator.png' ?>" />
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if ($this->wowmodule->getStatusModule('User Panel')) : ?>
                <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if ($this->wowmodule->getStatusModule('Donation') == '1') : ?>
                <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?= $this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if ($this->wowmodule->getStatusModule('Vote') == '1') : ?>
                <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?= $this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if ($this->wowmodule->getStatusModule('Store') == '1') : ?>
                <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?= $this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if ($this->wowmodule->getStatusModule('Bugtracker') == '1') : ?>
                <li class="uk-active"><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?= $this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if ($this->wowmodule->getStatusModule('Changelogs') == '1') : ?>
                <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?= $this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
              <?php if ($this->wowmodule->getStatusModule('Download') == '1') : ?>
                <li><a href="<?= base_url('download'); ?>"><i class="fas fa-download"></i> <?= $this->lang->line('tab_download'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= $this->lang->line('tab_changelogs'); ?></h4>
            <?php if ($this->changelogs_model->getAll()->num_rows()) : ?>
              <div class="uk-grid uk-grid-small uk-child-width-1-1" data-uk-grid>
                <?php foreach ($this->changelogs_model->getChangelogs()->result() as $changelogsList) : ?>
                  <div>
                    <div class="uk-card uk-card-default uk-margin-small">
                      <div class="uk-card-header">
                        <div class="uk-grid uk-grid-small" data-uk-grid>
                          <div class="uk-width-expand@s">
                            <h5 class="uk-h5 uk-text-bold"><i class="fas fa-file-alt"></i> N&#176 <?= $changelogsList->title ?></h5>
                          </div>
                          <div class="uk-width-auto@s">
                            <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j', $changelogsList->date); ?></p>
                          </div>
                        </div>
                      </div>
                      <div class="uk-card-body">
                        <?= $changelogsList->description ?>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else : ?>
              <div class="uk-alert-warning" uk-alert>
                <p class="uk-text-center"><i class="fas fa-exclamation-triangle"></i> <?= $this->lang->line('alert_changelog_not_found'); ?></p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>