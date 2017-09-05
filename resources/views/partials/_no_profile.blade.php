<div class="no-profile">
	<p>Ops, parece que esse usuário ainda não preencheu o seu perfil.</p>
    @if ($user->currentUser())
	   <p>{!! link_to_route('profile.create', 'Que tal fazer isso agora?') !!}</p>
    @endif
</div>