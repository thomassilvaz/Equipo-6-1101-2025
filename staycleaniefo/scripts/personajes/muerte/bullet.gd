extends Area2D

var direction = Vector2.RIGHT
var speed = 500

#el ataque se desplaza a la velocidad y direccion asignada
func _physics_process(delta):
	position += direction * speed * delta
 
#lastima a los npcs que reciban la funcion
func _on_body_entered(body):
	body.take_damage()
 
#al activarse el ataque, se muestra su sonido y animacion
func _ready() -> void:
	$AudioStreamPlayer2D.play()
	var animacion = $AnimationPlayer
	animacion.play("ataque")
	await animacion.animation_finished
	queue_free() #al terminar la animacion el ataque se elimina
