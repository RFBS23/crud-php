//apellidos
const alertPlaceholder = document.getElementById('apellidos')
const alert = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')
  alertPlaceholder.append(wrapper)
}
const alertApellidos = document.getElementById('liveAlertBtn')
if (alertApellidos) {
  alertApellidos.addEventListener('click', () => {
    alert("<i class='fa-solid fa-triangle-exclamation'></i> Escribe tus Apellidos", 'warning')
  })
}

//nombre
const alertP = document.getElementById('nombres')

const alerts = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertNombres = document.getElementById('liveAlertBtn')
if (alertNombres) {
  alertNombres.addEventListener('click', () => {
    alerts("<i class='fa-solid fa-triangle-exclamation'></i> Escribe tus Nombres", 'warning')
  })
}

//telefono
const alertPl = document.getElementById('telefono')

const alertas = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertTelefono = document.getElementById('liveAlertBtn')
if (alertTelefono) {
  alertTelefono.addEventListener('click', () => {
    alertas("<i class='fa-solid fa-triangle-exclamation'></i> Escribe tu Numero Telefonico", 'warning')
  })
}

//correo
const alertPla = document.getElementById('correo')

const alertemail = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertCorreos = document.getElementById('liveAlertBtn')
if (alertCorreos) {
  alertCorreos.addEventListener('click', () => {
    alertemail("<i class='fa-solid fa-triangle-exclamation'></i> Escribe tu Correo", 'warning')
  })
}

//contraseña
const alertPlac = document.getElementById('contra')

const alertpass = (message, type) => {
  const wrapper = document.createElement('div')
  wrapper.innerHTML = [
    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
    `   <div>${message}</div>`,
    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
    '</div>'
  ].join('')

  alertPlaceholder.append(wrapper)
}

const alertContra = document.getElementById('liveAlertBtn')
if (alertContra) {
  alertContra.addEventListener('click', () => {
    alertpass("<i class='fa-solid fa-triangle-exclamation'></i> Escribe tus Nombres", 'warning')
  })
}

