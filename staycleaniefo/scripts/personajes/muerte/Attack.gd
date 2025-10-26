extends State

#accede la funcion de entrar en estado desde el script extendido
func enter():
	super.enter()
	combo()
 
#empieza con la primera animacion de ataque
func attack(move = "1"):
	animation_player.play("attack_" + move)
	await animation_player.animation_finished
 
#activa el sonido ingresado
func sonido(path: String):
	AudioPlayer.play_fx(path)

#usa las animaciones de ataque segun el orden
func combo():
	var move_set = ["1","1","2"]
	for i in move_set:
		await attack(i)
 
	combo()
 
#cambia de estado segun la distancia del boss al jugador
func transition():
	if owner.direction.length() > 120:
		get_parent().change_state("Follow")
