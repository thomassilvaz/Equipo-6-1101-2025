extends State

func enter():
	super.enter() #accede la funcion de entrar en estado desde el script extendido
	animation_player.play("death") # se activa la animacion de muerte
	AudioPlayer.play_fx("res://Audio/FX/muerte_defeat.ogg") #se activa el sonido de muerte

#muestra la animacion de victoria cuando el boss muere
func boss_slained():
	animation_player.play("boss_slained")
