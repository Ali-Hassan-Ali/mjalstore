<div class="dataPuch">
    <form class="form-puch">

        @if(count($categories))
            <x-input.option required="true" name="categories" label="menu.categories" :lists="$categories" :value="old('categories')"/>
        @endif

        <x-input.option :disabled="true" required="true" name="sub_categories" label="menu.sub_categories" :lists="[]" :value="old('sub_categories')"/>

        <x-input.option :disabled="true" required="true" name="market_id" label="menu.markets" :lists="[]" :value="old('market_id')"/>

        <x-input.option :disabled="true" required="true" name="card_id" label="menu.cards" :lists="[]" :value="old('card_id')"/>

        <div class="form-group">
            <button class="btn-shop" id="btn-next" hidden>التالي</button>
        </div>
    </form>
</div>