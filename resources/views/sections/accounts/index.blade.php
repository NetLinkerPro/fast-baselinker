@extends('fast-baselinker::vendor.indigo-layout.main')

@section('meta_title', __('fast-baselinker::accounts.meta_title')  . ' // ' . config('app.name'))
@section('meta_description', __('fast-baselinker::accounts.meta_description'))

@push('head')
    @include('fast-baselinker::integration.favicons')
    @include('fast-baselinker::integration.ga')
@endpush

@section('create_button')
    <button class="frame__header-add" @click="AWES.emit('modal::form:open')"><i class="icon icon-plus"></i></button>
@endsection

@section('content')
       <div class="section">
        @table([
            'name' => 'accounts_table',
            'row_url'=> route('fast-baselinker.accounts.index') . '/{id}',
            'scope_api_url' => route('fast-baselinker.accounts.scope'),
            'scope_api_params' => ['']
        ])
        <template slot="header">
            <h3>{{__('fast-baselinker::accounts.account_list') }}</h3>
        </template>

            <tb-column name="name" label="{{ __('fast-baselinker::general.name') }}">
                <template slot-scope="col">
                    @{{ col.data.name }}
                </template>
            </tb-column>
            <tb-column name="api_token" label="{{ __('fast-baselinker::general.api_token') }}">
                <template slot-scope="col">
                    @{{ col.data.api_token }}
                </template>
            </tb-column>
            <tb-column name="">
                <template slot-scope="d">
                    <context-menu right boundary="table">
                        <button type="submit" slot="toggler" class="btn">
                            {{ __('fast-baselinker::general.options') }}
                        </button>
                        <cm-button @click="AWES._store.commit('setData', {param: 'editAccount', data: d.data}); AWES.emit('modal::edit-account:open')">
                            {{ __('fast-baselinker::general.edit') }}
                        </cm-button>
                        <cm-button @click="AWES._store.commit('setData', {param: 'deleteAccount', data: d.data}); AWES.emit('modal::delete-account:open')">
                            {{ __('fast-baselinker::general.delete') }}
                        </cm-button>
                    </context-menu>
                </template>
            </tb-column>
        @endtable
    </div>
@endsection

@section('modals')

    {{--Add account--}}
    <modal-window name="form" class="modal_formbuilder" title="{{ __('fast-baselinker::accounts.addition_account') }}">
        <form-builder url="{{ route('fast-baselinker.accounts.store') }}" @sended="AWES.emit('content::accounts_table:update')"
                      send-text="{{ __('fast-baselinker::general.add') }}"
                      cancel-text="{{ __('fast-baselinker::general.cancel') }}">
            <div class="section">
                <fb-input name="name" label="{{ __('fast-baselinker::general.name') }}"></fb-input>
                <fb-input name="api_token" label="{{ __('fast-baselinker::general.api_token') }}"></fb-input>
            </div>
        </form-builder>
    </modal-window>

    {{--Edit account--}}
    <modal-window name="edit-account" class="modal_formbuilder" title="{{ __('fast-baselinker::accounts.edition_account') }}">
        <form-builder method="PATCH" url="{{ route('fast-baselinker.accounts.index') }}/{id}" store-data="editAccount" @sended="AWES.emit('content::accounts_table:update')"
                      send-text="{{ __('fast-baselinker::general.save') }}"
                      cancel-text="{{ __('fast-baselinker::general.cancel') }}">
            <fb-input name="name" label="{{ __('fast-baselinker::general.name') }}"></fb-input>
            <fb-input name="api_token" label="{{ __('fast-baselinker::general.api_token') }}"></fb-input>
        </form-builder>
    </modal-window>

    {{--Delete account--}}
    <modal-window name="delete-account" class="modal_formbuilder" title="{{ __('fast-baselinker::accounts.are_you_sure_delete_account') }}">
        <form-builder name="delete-account" method="DELETE" url="{{ route('fast-baselinker.accounts.index') }}/{id}" store-data="deleteAccount" @sended="AWES.emit('content::accounts_table:update')"
                      send-text="{{ __('fast-baselinker::general.yes') }}"
                      cancel-text="{{ __('fast-baselinker::general.no') }}"
                      disabled-dialog>
            <template slot-scope="block">
                <!-- Fix enable button yes for delete -->
                <input type="hidden" name="isEdited" :value="AWES._store.state.forms['delete-account']['isEdited'] = true"/>
            </template>
        </form-builder>
    </modal-window>

@endsection
