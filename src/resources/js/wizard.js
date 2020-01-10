user = sessionStorage["username"];

mode = {
    none: '',
    create: 'create',
    update: 'update'
}

context = {
    none: {
        id: '',
        name: ''
    },
    overview: {
        id: 'overview',
        name: 'Overview'
    },
    warmup: {
        id: 'warmup',
        name: 'Warmup'
    }
}

wizard = $('#training-day-wizard');
wizard.call = (endpoint, handler) => {
    $.ajax({
        url: ('https://workout.marco-leweke.de/api/' + endpoint)
    }).done((response) => {
        if(response.status === 'Error') {
            alert("An internal error occurred: Please reload the application!")
            wizard.cancel();
        } else {
            if(typeof handler !== 'undefined') {
                handler(response);
            }
        }
    });
}
wizard.setId = (id) => {
    wizard.attr('training-day-id', id);
}
wizard.id = () => {
    return wizard.attr('training-day-id');
}
wizard.setMode = (newMode) => {
    wizard.attr('edit-mode', newMode);
}
wizard.mode = () => {
    return wizard.attr('edit-mode');
}
wizard.setContext = (newContext) => {
    wizard.attr('edit-context', newContext.id);
    $('#training-day-subtype').text(newContext.name);
}
wizard.context = () => {
    return wizard.attr('edit-context');
}
wizard.setTrainingDay = (trainingDay) => {
    wizard.attr('training-day', trainingDay);
}
wizard.trainingDay = () => {
    return wizard.attr('training-day');
}
wizard.newTraining = () => {
    wizard.setMode(mode.create);
    wizard.setTrainingDay((routines.lastDay() + 1));
    wizard.setContext(context.overview);
    wizard.call(('createTraining?user=' + user), function(response) {
        wizard.setId(response.id);
    });
}
wizard.cancel = () => {
    if(wizard.mode() === mode.create) {
        wizard.call('deleteTraining?id=' + wizard.id());
    }
    wizard.setContext(context.none);
    wizard.setMode(mode.none);
    wizard.setId('');
}
wizard.on('hide.bs.modal', function() {
    wizard.cancel();
});
