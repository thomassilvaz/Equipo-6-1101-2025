extends CharacterBody2D

@onready var player = get_parent().find_child("jugador")
@onready var animation = $AnimatedSprite2D

#activa el movimiento del enemigo cuando su animacion de spawn termina
func _ready():
	set_physics_process(false)
	await animation.animation_finished
	set_physics_process(true)
	animation.play("idle")

#sigue de forma precisa la posicion del jugador
func _physics_process(_delta):
	var direction = player.position - position
	velocity = direction.normalized() * 666
	move_and_slide()

#al ser atacado, el enemigo activa su animacion de muerte y este es borrado posteriormente
func take_damage():
	set_physics_process(false)
	animation.play("death")
	await animation.animation_finished
	queue_free()
