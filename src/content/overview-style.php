<style id="overview-style" media="screen">
#preview-frame-desktop {
    z-index: 1000;
    position: fixed;
    bottom: 1rem;
    right: 1rem;
    border-radius: 5px;
}
#preview-frame-desktop img {
    height: auto;
    width: 250px;
    border-radius: 5px;
    box-shadow: 3px 3px 5px 0px rgba(0,0,0,0.75);
}
#preview-frame-mobile img {
    height: auto;
    width: 250px;
    margin: 0 auto;
    border-radius: 5px;
}
#days-overview img {
    max-height: 480px;
}
.workout-modal .modal-header {
    border-bottom: none;
    padding-bottom: 0;
}
.workout-modal .modal-footer {
    border-top: none;
    padding-top: 0;
}
.workout-table {
    width: unset;
    margin: auto;
}
.preview-btn {
    font-size: 1.5rem;
    font-weight: 700;
    opacity: .5;
}
.preview-btn:disabled {
    opacity: .1;
}
.workout-name:hover,
.program-name:hover {
    cursor: pointer;
}
.loading {
    opacity: .5;
}
@media screen and (max-width: 767px) {
    #program-description {
        margin-top: 1rem;
    }
    .img-muscles {
        padding-top: 25px;
    }
}
</style>
