const defTitle = 'Hip Hop Blog'

var meta = {}

meta.json = () => {
  return {
    title: {
      inner: ''
    },
    meta: [
      { n: 'application-name', c: defTitle }
    ]
  }
}

meta.addTitle = (json, title) => {
  // json.title.inner = title
  json.meta.push({ n: 'twitter:title', c: title })
  json.meta.push({ p: 'og:title', c: title })
  json.meta.push({ itemprop: 'name', c: title })
}

meta.addImage = (json, desc) => {
  json.meta.push({ n: 'description', c: desc, id: 'meta-desc' })
  json.meta.push({ n: 'twitter:description', c: desc })
  json.meta.push({ p: 'og:description', c: desc })
}

meta.addImage = (json, image) => {
  meta.json.meta.push({ p: 'og:image', c: image })
}

export default meta
