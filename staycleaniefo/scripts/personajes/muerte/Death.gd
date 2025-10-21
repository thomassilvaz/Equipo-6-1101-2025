extends State
 
func enter():
	super.enter()
	animation_player.play("death")
	AudioPlayer.play_fx("res://Audio/FX/muerte_defeat.ogg")
 
func boss_slained():
	animation_player.play("boss_slained")
