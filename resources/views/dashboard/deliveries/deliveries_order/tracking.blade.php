
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="mb-3 input-group">
            <select class="custom-select" required name="trackMethod" id="inputGroupSelect02">
              <option>الـرجاء الاختيار احدهم</option>
              <option name="byOrderNumber"selected value="byOrderNumber" >رقـم الطلبية</option>
              <option name="byUserEmail" value="byUserEmail">حسـاب صاحب الطـلبية</option>
              <option name="byPhoneNumber" value="byPhoneNumber" id="phoneNum">هاتـف صاحـب الطلبية</option>
            </select>
            <div class="input-group-append">
              <label class="input-group-text" for="inputGroupSelect02">Options</label>
            </div>
          </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="input-group">
            <input type="text" required class="form-control" name="trackKey" aria-label="Text input with segmented dropdown button">
            <div class="input-group-append">
              <button type="submit" class="btn btn-outline-primary">ابحـث</button>
            </div>
          </div>
    </div>
</div>
