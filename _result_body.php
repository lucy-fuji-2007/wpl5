<div class="wrapper">

  <!-- Method badge -->
  <div class="method-badge"><?= htmlspecialchars($method) ?> &nbsp;·&nbsp; <?= htmlspecialchars($source) ?></div>

  <!-- Status Banner -->
  <div class="banner <?= $success ? 'success' : 'error' ?>">
    <div class="banner-icon"><?= $success ? '🎉' : '⚠️' ?></div>
    <div>
      <h2><?= $success ? 'Registration Successful!' : 'Validation Failed' ?></h2>
      <p><?= $success
            ? 'Your details have been received and processed successfully.'
            : 'Please fix the errors below and resubmit the form.' ?></p>
    </div>
  </div>

  <!-- Errors -->
  <?php if (!$success): ?>
  <div class="errors-card">
    <h3>🔴 Errors Found (<?= count($errors) ?>)</h3>
    <ul>
      <?php foreach ($errors as $field => $msg): ?>
      <li>
        <span class="field-name"><?= ucwords(str_replace('_',' ', $field)) ?>:</span>
        <?= htmlspecialchars($msg) ?>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <?php endif; ?>

  <!-- Data Table -->
  <div class="data-card">
    <div class="data-card-header">
      <h3>Submitted Registration Details</h3>
      <span><?= date('d M Y, H:i:s') ?></span>
    </div>
    <table>
      <?php foreach ($data as $label => $value): ?>
      <tr>
        <td><?= htmlspecialchars($label) ?></td>
        <td><?= $value /* already sanitised above */ ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <!-- Actions -->
  <div class="actions">
    <a href="index.html" class="btn btn-secondary">← Back to Form</a>
    <?php if ($success): ?>
    <a href="index.html" class="btn btn-primary">Register Another</a>
    <?php else: ?>
    <a href="javascript:history.back()" class="btn btn-primary">Fix Errors →</a>
    <?php endif; ?>
  </div>

</div>
