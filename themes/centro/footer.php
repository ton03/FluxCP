      </div>
    </main>
    <aside id="sidebar">
      <div class="sidebar__content">
        <section class="server-info">
          <h2>Server Information</h2>
          <p>Time: <span class="server-time"></span></p>
          <p class="status <?= $isServerUp ? 'status--online' : '' ?>">
            Status: <?= $isServerUp ? 'Online' : 'Maintenance' ?>
          </p>
          <p class="rates__normal">Rates: 30x EXP, 2x Drop</p>
          <p>
            Happy Hour Schedule:<br />
            2:00 to 4:00 AM/PM<br />
            8:00 to 10:00 AM/PM
          </p>
        </section>
      </div>
    </aside>
  </div>
  <script src="<?php echo $this->themePath('scripts.js') ?>"></script>
</body>
</html>
