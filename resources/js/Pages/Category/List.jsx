import { useForm } from "@inertiajs/react"

export default function List({categories}) {
  const { setData, post, processing, errors } = useForm({
    name: '',
  })

  function submit(e) {
    e.preventDefault()
    post(route('categories.store'))
  }

  return <div>
    <pre>{JSON.stringify(categories.data, null, 2)}</pre>
    <div>
      <form onSubmit={submit}>
        <input type="text" name="name" onChange={e => setData('name', e.target.value)}/>
        {errors.name && <div>{errors.name}</div>}
        <button type="submit" disabled={processing}>Save</button>
      </form>
    </div>
  </div>
}