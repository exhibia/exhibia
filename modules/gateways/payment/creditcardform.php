<p>
    <label class="label"><?php echo CARD_TYPE; ?>:</label>
    <select name="creditCardType" class="gothicey">
        <option value=Visa selected><?php echo VISA; ?></option>
        <option value=MasterCard><?php echo MASTERCARD; ?></option>
        <option value=Discover><?php echo DISCOVER; ?></option>
        <option value=Amex><?php echo AMERICAN_EXPRESS; ?></option>
    </select>
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo FIRST_NAME_ON_CARD; ?>:</label>
    <input name="firstName" type="text" size="20" class="crdtextbox" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo LAST_NAME_ON_CARD; ?>:</label>
    <input name="lastName" type="text" size="20" class="crdtextbox" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo ENTER_ADDRESS; ?>:</label>
    <input name="address1" type="text" size="20" class="crdtextbox" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo ADDRESS_LINE; ?> 2:</label>
    <input name="address2" type="text" size="20" class="crdtextbox" />
</p>

<p>
    <label class="label"><?php echo CITY; ?>:</label>
    <input name="city" type="text" size="20" class="crdtextbox" />
    <span>*</span>
</p>
<p>
    <label class="label"><?php echo STATE; ?>:</label>
    <select name="state" class="gothicey">
        <option value=></option>
        <option value=AK>AK</option>
        <option value=AL>AL</option>
        <option value=AR>AR</option>
        <option value=AZ>AZ</option>
        <option value=CA selected>CA</option>
        <option value=CO>CO</option>
        <option value=CT>CT</option>
        <option value=DC>DC</option>
        <option value=DE>DE</option>
        <option value=FL>FL</option>
        <option value=GA>GA</option>
        <option value=HI>HI</option>
        <option value=IA>IA</option>
        <option value=ID>ID</option>
        <option value=IL>IL</option>
        <option value=IN>IN</option>
        <option value=KS>KS</option>
        <option value=KY>KY</option>
        <option value=LA>LA</option>
        <option value=MA>MA</option>
        <option value=MD>MD</option>
        <option value=ME>ME</option>
        <option value=MI>MI</option>
        <option value=MN>MN</option>
        <option value=MO>MO</option>
        <option value=MS>MS</option>
        <option value=MT>MT</option>
        <option value=NC>NC</option>
        <option value=ND>ND</option>
        <option value=NE>NE</option>
        <option value=NH>NH</option>
        <option value=NJ>NJ</option>
        <option value=NM>NM</option>
        <option value=NV>NV</option>
        <option value=NY>NY</option>
        <option value=OH>OH</option>
        <option value=OK>OK</option>
        <option value=OR>OR</option>
        <option value=PA>PA</option>
        <option value=RI>RI</option>
        <option value=SC>SC</option>
        <option value=SD>SD</option>
        <option value=TN>TN</option>
        <option value=TX>TX</option>
        <option value=UT>UT</option>
        <option value=VA>VA</option>
        <option value=VT>VT</option>
        <option value=WA>WA</option>
        <option value=WI>WI</option>
        <option value=WV>WV</option>
        <option value=WY>WY</option>
        <option value=AA>AA</option>
        <option value=AE>AE</option>
        <option value=AP>AP</option>
        <option value=AS>AS</option>
        <option value=FM>FM</option>
        <option value=GU>GU</option>
        <option value=MH>MH</option>
        <option value=MP>MP</option>
        <option value=PR>PR</option>
        <option value=PW>PW</option>
        <option value=VI>VI</option>
    </select>
    <span>*</span>
</p>
<p>
    <label class="label"><?php echo POSTAL_CODE; ?>:</label>
    <input name="zip" type="text" size="8" class="crdtextbox" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo CARD_NUMBER; ?>:</label>
    <input name="creditCardNumber" id="creditCardNumber" type="text" class="crdtextbox" size="20" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo CVV2_SECURITY_CODE; ?>:</label>
    <input name="cvv2Number" id="cvv2Number" type="text" class="crdtextbox" size="3" maxlength="3" style="width: 60px;" />
    <span>*</span>
</p>

<p>
    <label class="label"><?php echo EXPIRY_DATE; ?>:</label>
    <select name="expDateMonth" class="gothicey" ><?php for ($i = 1; $i <= 12; $i++) { ?>
        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php
    }
        ?>
    </select>

    <select name="expDateYear" class="gothicey"> <?php for ($i = 2009; $i <= 2025; $i++) { ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
        <?php
        }
        ?>
    </select>
    <span>*</span>
</p>