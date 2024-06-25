  <section class="contact p-3">
    <form method="post" enctype="multipart/form-data">
      <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="question-tab" data-toggle="tab" href="#question" role="tab" aria-controls="home" aria-selected="true">Wyślij pytanie</a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="profile" aria-selected="false">Pytanie dotyczące opłat</a>
        </li>-->
      </ul>
      <div class="form-group">
        <input type="email" name="email" class="form-control" placeholder="Adres e-mail" required />
      </div>
      <div class="form-group">
        <textarea name="message" class="form-control" rows="4" placeholder="Wiadomość" required></textarea>
      </div>
      <div class="tab-content text-right" id="myTabContent">
        <div class="tab-pane fade show active" id="question" role="tabpanel" aria-labelledby="question-tab">
          <button type="submit" name="send" value="1" class="btn btn-success">Wyślij</button>
        </div>
        <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="payments-tab">
          <!--<input type="file" name="attachment" id="att" class="d-none" />
          <label for="att"><span class="btn btn-success">Dodaj załącznik</span></label>-->
          <button type="submit" name="send" value="1" class="btn btn-success">Wyślij</button>
        </div>
      </div>
    </form>
  </section>
