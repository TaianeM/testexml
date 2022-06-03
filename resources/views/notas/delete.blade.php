<form action="{{ route('notas.destroy', $nota->id) }}" method="post">
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <h5 class="text-center fw-bold"
        >Você tem certeza que deseja excluir esse usuário?
        </h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"
           >Não
        </button>
        <button type="submit" class="btn btn-danger"
           >Sim
        </button>
    </div>
</form>
