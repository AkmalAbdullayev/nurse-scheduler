@extends('layouts.master')

@section('content')
    <livewire:school.store/>
    <!-- Modal -->
    <div class="modal fade" id="deletModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
         tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="modal-body-title">Are you sure you want to delete</h3>
                    <p class="modal-body-desc">Belinda Michelle Gates record?</p>
                    <div class="modal-body-btn">
                        <a class="modal-body-btn-outline" data-bs-dismiss="modal">Cancel</a>
                        <button class="modal-body-btn-red" id="delete-btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <footer class="footer">
        <div class="container"></div>
    </footer>
@endsection

@push('js')
    <script>
        window.onload = function () {
            document.getElementById("cancel-btn").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'school');
            });

            document.getElementById("submit-btn").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'school');
            });

            document.getElementById("delete-btn").addEventListener('click', (event) => {
                localStorage.setItem('tab', 'school');
            });
        }
    </script>
@endpush
