user = sessionStorage["username"];

mode = {
    none: '',
    create: 'create',
    update: 'update'
}

context = {
    none: {
        id: 'tab-none',
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

wizard.id = {
    get: () => {
        return wizard.attr('training-day-id');
    },
    set: (newId) => {
        wizard.attr('training-day-id', newId);
    }
}
wizard.mode = {
    get: () => {
        return wizard.attr('edit-mode');
    },
    set: (newMode) => {
        wizard.attr('edit-mode', newMode);
    }
}
wizard.context = {
    get: () => {
        return wizard.attr('edit-context');
    },
    set: (newContext) => {
        wizard.attr('edit-context', newContext.id);
        $('#training-day-subtype').text(newContext.name);
        wizard.find('.active').removeClass('active');
        wizard.find(('#' + newContext.id)).addClass('active');
    }
}
wizard.trainingDay = {
    get: () => {
        return wizard.attr('training-day');
    },
    set: (newTrainingDay) => {
        wizard.attr('training-day', newTrainingDay);
    }
}
wizard.newTraining = () => {
    wizard.mode.set(mode.create);
    wizard.trainingDay.set((routines.lastDay() + 1));
    wizard.context.set(context.overview);
    api.createTraining(user, wizard.trainingDay.get(), function(response) {
        wizard.id.set(response.id);
    });
}
wizard.clear = () => {
    wizard.context.set(context.none);
    wizard.mode.set(mode.none);
    wizard.trainingDay.set('');
    wizard.id.set('');
}
wizard.save = () => {
    wizard.clear();
}
wizard.cancel = () => {
    if(wizard.mode.get() === mode.create) {
        api.deleteTraining(wizard.id.get());
    }
    wizard.clear();
}
wizard.on('hide.bs.modal', function() {
    wizard.cancel();
});
