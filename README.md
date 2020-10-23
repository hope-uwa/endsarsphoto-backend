## About ENDSARS PHOTOS

API Implementation of pictures from #ENDSARS protest


## Technology

- PHP/Laravel
- Google API
- Postgres
- Cloudinary

## Routes
```
GET /api/post
GET /api/post/{id}
POST /api/post
PUT /api/post/{id}
DELETE /api/post/{id}

GET /api/search?description=texts&&note=texts&&state=2&&most_recent=desc|asc
GET /api/states

Pictures

GET /api/post/{postId}/picture
GET /api/post/{postId}/picture/{pictureId}
POST /post/{postId}/picture
DELETE /api/post/{postId}/picture/{pictureId}
```

## Contributing

Feel free to raise an issues ticket for any bugs, or new features. 


## License

The EndSARS Photos Application is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
